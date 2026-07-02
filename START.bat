@echo off
title School ERP - Start
echo.
echo ============================================
echo   School Exam ^& Result Management System
echo ============================================
echo.

cd /d "%~dp0"

echo [1] Checking MySQL (port 3306)...
powershell -Command "(Test-NetConnection 127.0.0.1 -Port 3306 -WarningAction SilentlyContinue).TcpTestSucceeded" | findstr /i "True" >nul
if errorlevel 1 (
    echo.
    echo  ERROR: MySQL is NOT running!
    echo  - Open XAMPP Control Panel
    echo  - Click START next to MySQL
    echo  - Then run this file again
    echo.
    pause
    exit /b 1
)
echo      MySQL is running.

echo.
echo [2] Running migrations...
php artisan migrate --force
if errorlevel 1 (
    echo.
    echo  Migration failed. Create database in phpMyAdmin:
    echo  Name: school_management
    echo.
    pause
    exit /b 1
)

echo.
echo [3] Starting server at http://127.0.0.1:8000
echo     Login: admin@school.com / password
echo     Press Ctrl+C to stop
echo.

if exist "public\hot" del "public\hot"

php artisan serve --host=127.0.0.1 --port=8000
