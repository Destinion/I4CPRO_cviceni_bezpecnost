<?php
// jednoduchý loader .env (bez závislostí)
$env = [];
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
if (strpos(trim($line), '#') === 0) continue;
[$k, $v] = array_map('trim', explode('=', $line, 2));
$env[$k] = $v;
}
}


$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbUser = $env['DB_USER'] ?? 'root';
$dbPass = $env['DB_PASS'] ?? '';
$dbName = $env['DB_NAME'] ?? 'security_demo';


$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
// NEVYPISUJTE DETAILY NA PRODUKCI
if (($env['APP_ENV'] ?? 'production') === 'development') {
die('DB connection error: ' . $conn->connect_error);
} else {
error_log('DB connection error: ' . $conn->connect_error);
die('Internal error.');
}
}
// nastavíme charset
$conn->set_charset('utf8mb4');


return $conn;