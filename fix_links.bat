@echo off
echo Fixing .html to .php links in all PHP files...

:: Fix navigation links
powershell -Command "(gc about.php) -replace '\.html', '.php' | Out-File -encoding ASCII about.php"
powershell -Command "(gc admin.php) -replace '\.html', '.php' | Out-File -encoding ASCII admin.php"
powershell -Command "(gc athletics.php) -replace '\.html', '.php' | Out-File -encoding ASCII athletics.php"
powershell -Command "(gc ball-games.php) -replace '\.html', '.php' | Out-File -encoding ASCII ball-games.php"
powershell -Command "(gc blog.php) -replace '\.html', '.php' | Out-File -encoding ASCII blog.php"
powershell -Command "(gc board-games.php) -replace '\.html', '.php' | Out-File -encoding ASCII board-games.php"
powershell -Command "(gc index.php) -replace '\.html', '.php' | Out-File -encoding ASCII index.php"
powershell -Command "(gc martial-arts.php) -replace '\.html', '.php' | Out-File -encoding ASCII martial-arts.php"
powershell -Command "(gc registration.php) -replace '\.html', '.php' | Out-File -encoding ASCII registration.php"
powershell -Command "(gc schedule.php) -replace '\.html', '.php' | Out-File -encoding ASCII schedule.php"
powershell -Command "(gc throwing-games.php) -replace '\.html', '.php' | Out-File -encoding ASCII throwing-games.php"

echo All .html links have been converted to .php!
pause