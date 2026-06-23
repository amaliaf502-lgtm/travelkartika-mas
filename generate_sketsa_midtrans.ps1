$text = Get-Content -Path 'c:\laragon\www\travelkartika-mas\sketsa_midtrans_popup.puml' -Raw
Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile 'c:\laragon\www\travelkartika-mas\sketsa_midtrans_popup.png'
