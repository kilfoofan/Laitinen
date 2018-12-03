<?php
session_start();
require_once 'laitinenConn.php';
if (isset($_POST['name'])) { // jos lisäysdialogin tallenna-nappia on painettu
    $na = $_POST['name'];
    $mo = $_POST['model'];
    $ma = $_POST['make'];
    $de = $_POST['description'];
    $lo = $_POST['location'];
    $ow = $_POST['owner'];
    $ca = $_POST['category'];
    $sn = $_POST['serial'];
    $ir = 0; //isReserved
    $il = 0; //isOnLoan
    $rs = 0; //reservations

    $na = mysqli_real_escape_string($conn, $na);
    $mo = mysqli_real_escape_string($conn, $mo);
    $ma = mysqli_real_escape_string($conn, $ma);
    $de = mysqli_real_escape_string($conn, $de);
    $lo = mysqli_real_escape_string($conn, $lo);
    $ow = mysqli_real_escape_string($conn, $ow);
    $ca = mysqli_real_escape_string($conn, $ca);
    $sn = mysqli_real_escape_string($conn, $sn);

    $query = "INSERT INTO ". 
    "device (NAME, MODEL, MAKE, DESCRIPTION, LOCATION, OWNER, CATEGORY, SERIAL, ISRESERVED, ISONLOAN, RESERVATIONS) ".
    "VALUES ('".$na."', '".$mo."', '".$ma."', '".$de."', '".$lo."', '".$ow."', '".$ca."', '".$sn."', '".$ir."', '".$il."', '".$rs."')";
    error_log("insertDevice: ".$query);
    $response = @mysqli_query($conn, $query);

    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        //header('Location: Teht64.php?name='.$_SESSION['n'].'&address='.$_SESSION['o'].'&asty_avain='.$_SESSION['aa'].'&search=Hae');
        //exit();
        error_log("insert onnistui)");
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokannasta. Viesti: " . mysqli_error($conn) . "</p>";
    }
}
?>