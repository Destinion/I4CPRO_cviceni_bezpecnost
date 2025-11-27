<?php
require_once __DIR__ . '/../includes/session.php';
// bezpečné odhlášení
$_SESSION = [];
setcookie(session_name(), '', time() - 3600, '/');
session_destroy();
header('Location: index.php'); 
exit;
?>