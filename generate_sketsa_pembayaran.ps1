$text = Get-Content -Path 'c:\laragon\www\travelkartika-mas\sketsa_pembayaran.puml' -Raw
Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile 'c:\laragon\www\travelkartika-mas\sketsa_pembayaran.png'
