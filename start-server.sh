#!/bin/bash
# START SERVER - TRAVEL UMROH WEBSITE
# Run this file to start the Laravel development server

cd "$(dirname "$0")" || exit

echo "================================"
echo "🚀 STARTING TRAVEL UMROH WEBSITE"
echo "================================"
echo ""
echo "📍 Project: Travelkartika Mas"
echo "📂 Location: c:\laragon\www\travelkartika-mas"
echo ""
echo "Starting Laravel development server..."
echo ""
echo "🌐 Website will open at: http://localhost:8000"
echo ""
echo "Login credentials:"
echo "  Email: test@example.com"
echo "  Password: password"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""
echo "================================"
echo ""

php artisan serve

echo ""
echo "================================"
echo "✅ Server stopped"
echo "================================"
