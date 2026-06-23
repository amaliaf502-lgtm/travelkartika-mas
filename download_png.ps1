$text = Get-Content -Path 'c:\laragon\www\travelkartika-mas\temp_diagram.puml' -Raw
Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile 'C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\class_diagram_travelkartika.png'
