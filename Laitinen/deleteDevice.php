<?php
session_start();
require_once 'laitinenConn.php';
if (isset($_GET['id'])) { // key on Teht64.php:ssa type="hidden"
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);
    $query = "DELETE FROM device WHERE ID = $id";

    $response = @mysqli_query($conn, $query);

    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        //header('Location: Teht64.php?name='.$_SESSION['n'].'&address='.$_SESSION['o'].'&asty_avain='.$_SESSION['aa'].'&search=Hae');
        exit();
    } else {
        echo "<p style='color:red'>Virhe poistettaessa dataa tietokannasta. Viesti: " . mysqli_error($conn) . "</p>";
    }
}
?>