<?php
require_once __DIR__ . '/../includes/session.php';
$conn = require __DIR__ . '/../includes/db.php';


// jednoduchá ochrana proti bruteforce (v production použít robustnější řešení)
$ip = $_SERVER['REMOTE_ADDR'];
$now = time();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
header('Location: index.php'); exit;
}


$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';


if ($username === '' || $password === '') {
echo 'Chybí údaje.'; exit;
}


// prepared statement
$stmt = $conn->prepare('SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();


if ($user && password_verify($password, $user['password'])) {
// úspěšné přihlášení
session_regenerate_id(true);
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];
header('Location: admin.php'); exit;
} else {
// neúspěch: ukaž jen obecnou zprávu
echo 'Špatné jméno nebo heslo.'; exit;
}
?>