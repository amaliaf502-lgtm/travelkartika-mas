@echo off
REM START SERVER - TRAVEL UMROH WEBSITE
REM Run this file to start the Laravel development server

cd /d "%~dp0" || exit /b

echo.
echo ================================
echo.
echo    TRAVEL UMROH WEBSITE
echo    Travelkartika Mas
echo.
echo ================================
echo.
echo Starting Laravel development server...
echo.
echo Website akan dibuka di: http://localhost:8000
echo.
echo Login dengan:
echo   Email: test@example.com
echo   Password: password
echo.
echo Tekan Ctrl+C untuk menghentikan server
echo.
echo ================================
echo.

php artisan serve

echo.
echo ================================
echo Server telah dihentikan
echo ================================
pause
