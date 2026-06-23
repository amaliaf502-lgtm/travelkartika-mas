$files = @(
    "sketsa_login",
    "sketsa_register",
    "sketsa_home_hero",
    "sketsa_home_paket",
    "sketsa_cara_pendaftaran"
)

$artifactDir = "C:\Users\MY HP\.gemini\antigravity-ide\brain\d1e7f4c9-2768-4e44-8b35-5404a824934c"

foreach ($file in $files) {
    $pumlPath = "c:\laragon\www\travelkartika-mas\$file.puml"
    $pngPath = "$artifactDir\$file.png"
    
    if (Test-Path $pumlPath) {
        $text = Get-Content -Path $pumlPath -Raw
        Write-Host "Generating PNG for $file..."
        Invoke-RestMethod -Uri 'https://kroki.io/plantuml/png' -Method Post -Body $text -ContentType 'text/plain' -OutFile $pngPath
        Write-Host "Saved to $pngPath"
    } else {
        Write-Host "File not found: $pumlPath"
    }
}
Write-Host "Done!"
