<?php
// bezpečné nastavení session
if (session_status() === PHP_SESSION_NONE) {
$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_set_cookie_params([
'lifetime' => 0,
'path' => '/',
'domain' => '',
'secure' => $secure,
'httponly' => true,
'samesite' => 'Lax'
]);
ini_set('session.use_strict_mode', '1');
session_start();
}
?>