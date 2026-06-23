<?php
$transcript_path = "C:/Users/MY HP/.gemini/antigravity-ide/brain/786a0c8a-3286-4f96-a2d4-2155f34b1189/.system_generated/logs/transcript.jsonl";
$file_path = "resources/views/admin/pemesanans/show.blade.php";
$handle = fopen($transcript_path, "r");
$found = false;
while (($line = fgets($handle)) !== false) {
    $data = json_decode($line, true);
    if ($data && isset($data["type"]) && $data["type"] == "VIEW_FILE" && $data["status"] == "DONE") {
        $content = $data["content"];
        if (strpos($content, "File Path: `file:///c:/laragon/www/travelkartika-mas/" . $file_path . "`") !== false) {
            $lines = explode("\n", $content);
            $actual_code = [];
            $is_code = false;
            foreach ($lines as $l) {
                if (strpos($l, "The following code has been modified") !== false) {
                    $is_code = true;
                    continue;
                } elseif (strpos($l, "The above content") === 0) {
                    $is_code = false;
                    continue;
                }
                if ($is_code) {
                    if (preg_match("/^\d+: (.*)$/", $l, $m)) {
                        $actual_code[] = $m[1];
                    } elseif (preg_match("/^\d+:$/", $l)) {
                        $actual_code[] = "";
                    }
                }
            }
            if (!empty($actual_code)) {
                file_put_contents($file_path, implode("\n", $actual_code));
                echo "Restored original show.blade.php\n";
                $found = true;
                break;
            }
        }
    }
}
fclose($handle);
if (!$found) echo "Not found\n";

