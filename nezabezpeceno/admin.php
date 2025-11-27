<?php
session_start();

if (empty($_SESSION['username'])) {
    die("Přístup odepřen. Musíte se přihlásit.");
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Admin sekce</title>
</head>
<body>
    <h1>Admin sekce</h1>
    <p>Toto je tajná část webu. (V reálu by tu bylo něco důležitého.)</p>
    <p><a href="index.php">Zpět na hlavní stránku</a> | <a href="logout.php">Odhlásit</a></p>
</body>
</html>
