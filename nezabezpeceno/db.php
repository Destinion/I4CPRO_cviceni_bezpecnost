<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "security_demo";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    // ZRANITELNOST: vypisuje detailní chybu
    die("Connection failed: " . mysqli_connect_error());
}
?>
