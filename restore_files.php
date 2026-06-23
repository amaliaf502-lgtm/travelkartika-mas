import json
import re
import sys

transcript_path = r"C:\Users\MY HP\.gemini\antigravity-ide\brain\786a0c8a-3286-4f96-a2d4-2155f34b1189\.system_generated\logs\transcript.jsonl"
files_to_restore = [
    "resources/views/admin/pemesanans/verifikasi.blade.php",
    "resources/views/admin/pakets/kuota.blade.php",
    "resources/views/admin/departure-info/index.blade.php",
    "resources/views/admin/pemesanans/index.blade.php"
]

restored_files = set()

with open(transcript_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
        except json.JSONDecodeError:
            continue
            
        if data.get("type") == "VIEW_FILE" and data.get("status") == "DONE":
            content = data.get("content", "")
            
            for file_path in files_to_restore:
                if file_path in restored_files:
                    continue
                    
                # Look for the file path in the content
                if f"File Path: `file:///c:/laragon/www/travelkartika-mas/{file_path}`" in content:
                    # We found the first VIEW_FILE for this file!
                    # Now we need to extract the code.
                    # The code is after the line "The following code has been modified..."
                    # and has line numbers like "1: "
                    
                    lines = content.split('\n')
                    actual_code = []
                    is_code_section = False
                    
                    for l in lines:
                        if "The following code has been modified" in l:
                            is_code_section = True
                            continue
                        elif l.startswith("The above content"):
                            is_code_section = False
                            continue
                            
                        if is_code_section:
                            # Remove the leading line number like "1: " or "123: "
                            match = re.match(r"^\d+: (.*)$", l)
                            if match:
                                actual_code.append(match.group(1))
                            elif re.match(r"^\d+:$", l):
                                actual_code.append("")
                    
                    if actual_code:
                        with open(rf"c:\laragon\www\travelkartika-mas\{file_path}", 'w', encoding='utf-8') as out:
                            out.write('\n'.join(actual_code))
                        print(f"Restored: {file_path}")
                        restored_files.add(file_path)

print("Done restoring files.")
