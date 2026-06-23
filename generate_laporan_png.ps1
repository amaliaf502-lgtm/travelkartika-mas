$text = Get-Content -Path 'c:\laragon\www\travelkartika-mas\sketsa_laporan.puml' -Raw
Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile 'C:\Users\MY HP\.gemini\antigravity-ide\brain\d1e7f4c9-2768-4e44-8b35-5404a824934c\sketsa_laporan.png'
