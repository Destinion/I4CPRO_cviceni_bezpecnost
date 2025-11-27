<?php
// comment_debug.php  — pouze pro učební ukázku na lokálním serveru (NEPROVÁDĚJTE SQL)
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}

if (!csrf_check($_POST['csrf_token'] ?? '')) {
    die('CSRF token neplatný.');
}

$author = trim(substr($_POST['author'] ?? 'Anonym', 0, 50));
$content = trim(substr($_POST['content'] ?? '', 0, 2000));

if ($content === '') die('Komentář je prázdný.');

// SLOŽENÍ SQL jako text — NEPROVÁDÍME jej!
$sql = "INSERT INTO comments (author, content) VALUES ('" . addslashes($author) . "', '" . addslashes($content) . "');";

// Ukážeme ho studentům (bez vykonání)
echo "<h2>Ukázka složeného SQL (NEPROVÁDÍME)</h2>";
echo "<pre>" . htmlspecialchars($sql, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</pre>";
echo "<p>Vysvětli studentům: pokud by kód místo zobrazení tento řetězec spustil jako SQL, mohl by změnit syntaxi dotazu a způsobit jiné chování (např. výběr většího počtu řádků, mazání apod.).</p>";
?>
