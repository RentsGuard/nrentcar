$mysqls = Get-Process -Name mysqld -ErrorAction SilentlyContinue
$hadDuplicates = $mysqls.Count -gt 1

if ($hadDuplicates) {
    Write-Host "WARN: Found $($mysqls.Count) mysqld processes. Killing all for clean restart..."
    $mysqls | Stop-Process -Force
    Start-Sleep -Seconds 2
    $mysqlBin = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqld.exe"
    $mysqlCnf = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\my.ini"
    Start-Process -FilePath $mysqlBin -ArgumentList "--defaults-file=$mysqlCnf" -WindowStyle Hidden
    Start-Sleep -Seconds 4
    Write-Host "MySQL restarted cleanly."
} elseif ($mysqls.Count -eq 0) {
    Write-Host "No MySQL running. Starting..."
    $mysqlBin = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqld.exe"
    $mysqlCnf = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\my.ini"
    Start-Process -FilePath $mysqlBin -ArgumentList "--defaults-file=$mysqlCnf" -WindowStyle Hidden
    Start-Sleep -Seconds 5
} else {
    Write-Host "MySQL OK (1 process)"
}

php artisan serve
