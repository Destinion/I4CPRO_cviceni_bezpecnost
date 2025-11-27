<?php
session_start();
require_once "db.php";
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Security Demo</title>
</head>
<body>
    <h1>Security Demo – Webové zabezpečení</h1>

    <h2>Veřejná část</h2>
    <p>Toto je ukázkový web pro cvičení z bezpečnosti. Část je veřejná, část je jen pro přihlášené.</p>

    <hr>

    <h2>Přihlášení</h2>
    <?php
    if (!empty($_SESSION['username'])) {
        echo "<p>Jste přihlášen jako <strong>" . $_SESSION['username'] . "</strong>.</p>";
        echo '<p><a href="admin.php">Přejít do administrace</a> | <a href="logout.php">Odhlásit se</a></p>';
    } else {
    ?>
        <form method="post" action="login.php">
            <label>Uživatel: <input type="text" name="username"></label><br>
            <label>Heslo: <input type="password" name="password"></label><br>
            <button type="submit">Přihlásit</button>
        </form>
    <?php
    }
    ?>

    <hr>

    <h2>Komentáře (veřejné)</h2>

    <form method="post" action="comment.php">
        <label>Jméno: <input type="text" name="author"></label><br>
        <label>Komentář:<br>
            <textarea name="content" cols="40" rows="4"></textarea>
        </label><br>
        <button type="submit">Odeslat komentář</button>
    </form>

    <h3>Seznam komentářů:</h3>
    <?php
    $sql = "SELECT author, content FROM comments ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        // ZRANITELNOST: žádné escapování → XSS
        echo "<p><strong>" . $row['author'] . ":</strong> " . $row['content'] . "</p>";
    }
    ?>
</body>
</html>
