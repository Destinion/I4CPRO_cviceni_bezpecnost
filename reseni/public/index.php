<?php
require_once __DIR__ . '/../includes/session.php';
$conn = require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/csrf.php';


function e($s) { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }


// načíst komentáře
$stmt = $conn->prepare('SELECT author, content, created_at FROM comments ORDER BY id DESC LIMIT 100');
$stmt->execute();
$res = $stmt->get_result();
$comments = $res->fetch_all(MYSQLI_ASSOC);


?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Security Demo — bezpečná verze</title>
<style>
body{font-family:Arial,Helvetica,sans-serif;max-width:900px;margin:20px auto;padding:0 12px}
textarea{width:100%}
</style>
</head>
<body>
<h1>Security Demo — bezpečná verze</h1>


<p>Veřejná část webu. Studenti mohou přispívat komentáři — data budou správně ošetřena.</p>


<?php if (!empty($_SESSION['username'])): ?>
<p>Jste přihlášen jako <strong><?= e($_SESSION['username']) ?></strong>. <a href="admin.php">Administrace</a> | <a href="logout.php">Odhlásit</a></p>
<?php else: ?>
<form method="post" action="login.php">
<label>Uživatel: <input name="username" maxlength="50" required></label><br>
<label>Heslo: <input type="password" name="password" maxlength="255" required></label><br>
<button>Log in</button>
</form>
<?php endif; ?>


<hr>


<h2>Vložit komentář</h2>
<form method="post" action="comment.php">
<input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
<label>Jméno: <input name="author" maxlength="50"></label><br>
<label>Komentář:<br>
<textarea name="content" rows="4" maxlength="2000" required></textarea>
</label><br>
<button>Odeslat</button>
</form>


<h3>Komentáře</h3>
<?php foreach ($comments as $c): ?>
<article>
<p><strong><?= e($c['author']) ?></strong> — <small><?= e($c['created_at']) ?></small></p>
<div><?= nl2br(e($c['content'])) ?></div>
</article>
<hr>
<?php endforeach; ?>


</body>
</html>