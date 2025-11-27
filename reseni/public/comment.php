<?php
require_once __DIR__ . '/../includes/session.php';
$conn = require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/csrf.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
header('Location: index.php'); exit;
}


if (!csrf_check($_POST['csrf_token'] ?? '')) {
die('CSRF token neplatný.');
}


$author = trim(substr($_POST['author'] ?? 'Anonym', 0, 50));
$content = trim(substr($_POST['content'] ?? '', 0, 2000));
if ($content === '') {
die('Komentář je prázdný.');
}


$stmt = $conn->prepare('INSERT INTO comments (author, content) VALUES (?, ?)');
$stmt->bind_param('ss', $author, $content);
$stmt->execute();


header('Location: index.php'); 
exit;
?>
