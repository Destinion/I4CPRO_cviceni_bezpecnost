<?php
require_once "db.php";

$author = $_POST['author'] ?? 'Anonym';
$content = $_POST['content'] ?? '';

// ZRANITELNOST: bez kontroly délky, prázdných vstupů, XSS, atd.
$sql = "INSERT INTO comments (author, content) VALUES ('$author', '$content')";
mysqli_query($conn, $sql);

header("Location: index.php");
exit;
