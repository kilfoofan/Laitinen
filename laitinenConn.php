<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laitinendb";
// luodaan yhteys
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Tietokantayhteys epäonnistui: " . mysqli_connect_error());
}
//echo "<p style='color:green'>Tietokantayhteys muodostettu onnistuneesti </p>";
?>