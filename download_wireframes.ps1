$files = @("login", "registrasi", "pemesanan", "dashboard")
foreach ($file in $files) {
    $text = Get-Content -Path "c:\laragon\www\travelkartika-mas\salt_$file.puml" -Raw
    $outFile = "C:\Users\MY HP\.gemini\antigravity-ide\brain\4d09b22c-8efb-455d-a2cb-9740baef7a29\wireframe_$file.png"
    Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $outFile
}
