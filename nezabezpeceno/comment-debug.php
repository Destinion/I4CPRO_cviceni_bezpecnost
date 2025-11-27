<?php
// comment_debug.php – DEMO k nezabezpečené verzi, nic neukládá, jen ukazuje dotaz

// tady klidně ani nepotřebuješ session/csrf, jde jen o demonstraci
require_once "db.php"; // ať máš připojení, ale nic neprovádíme

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$author  = $_POST['author']  ?? 'Anonym';
$content = $_POST['content'] ?? '';

// přesně ten samý styl, jako nezabezpečený comment.php:
$sql = "INSERT INTO comments (author, content) VALUES ('$author', '$content')";

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>SQL injection – demonstrace dotazu</title>
</head>
<body>
    <h1>SQL injection – demonstrace na nezabezpečené verzi</h1>

    <p>Toto je <strong>nezabezpečený</strong> způsob skládání SQL dotazu:</p>

    <pre><?=
        htmlspecialchars(
            $sql,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );
    ?></pre>

    <p>
        <ul>
            <li>Celý obsah proměnné <code>$content</code> (a <code>$author</code>) se vkládá přímo do SQL dotazu mezi uvozovky.</li>
            <li>Pokud uživatel vloží takový text, že „uzavře“ tyto uvozovky a přidá část, která změní SQL (například jiný příkaz),
                server to poskládá do jednoho velkého dotazu.</li>
            <li>Tak by si útočník mohl vynutit třeba i nějaký destruktivní příkaz, například mazání řádků z tabulky komentářů. - DELETE FROM COMMENTS</li>
        </ul>
    </p>

    <p><a href="index.php">Zpět na stránku</a></p>
</body>
</html>
