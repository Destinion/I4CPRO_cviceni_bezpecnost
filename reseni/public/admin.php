<?php
require_once __DIR__ . '/../includes/session.php';
$conn = require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/csrf.php';


function e($s) { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }


if (empty($_SESSION['username'])) {
header('HTTP/1.1 403 Forbidden');
die('Přístup odepřen.');
}


// Jednoduché zobrazení administrace: možnost mazat komentáře
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete_id'])) {
if (!csrf_check($_POST['csrf_token'] ?? '')) die('CSRF token neplatný.');
$id = (int)$_POST['delete_id'];
$stmt = $conn->prepare('DELETE FROM comments WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
header('Location: admin.php'); exit;
}


// načteme komentáře
$stmt = $conn->prepare('SELECT id, author, content, created_at FROM comments ORDER BY id DESC LIMIT 200');
$stmt->execute();
$res = $stmt->get_result();
$comments = $res->fetch_all(MYSQLI_ASSOC);


?>
<!doctype html>
<html lang="cs">
<head><meta charset="utf-8"><title>Admin</title></head>
<body>
<h1>Admin: <?= e($_SESSION['username']) ?></h1>
<p><a href="index.php">Zpět</a> | <a href="logout.php">Odhlásit</a></p>


<h2>Komentáře</h2>
<?php foreach ($comments as $c): ?>
<article>
<p><strong><?= e($c['author']) ?></strong> — <small><?= e($c['created_at']) ?></small></p>
<div><?= nl2br(e($c['content'])) ?></div>
<form method="post" style="margin-top:6px">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
<input type="hidden" name="delete_id" value="<?= (int)$c['id'] ?>">
<button type="submit">Smazat</button>
</form>
</article>
<hr>
<?php endforeach; 
?>


</body>
</html>