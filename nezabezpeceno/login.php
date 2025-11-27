<?php
session_start();
require_once "db.php";

if (!isset($_POST['username'], $_POST['password'])) {
    die("Chybí přihlašovací údaje.");
}

$username = $_POST['username'];
$password = $_POST['password'];

// ZRANITELNOST: SQL injection, plaintext hesla
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = $username;
    header("Location: admin.php");
    exit;
} else {
    echo "Špatné jméno nebo heslo.";
}
