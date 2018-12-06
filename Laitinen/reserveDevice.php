<?php
//session_start();
require_once 'laitinenConn.php';
if (isset($_POST['save'])) { 
    error_log("insertUser onnistui ja post löytyi");
    $ud = $_POST['userid'];
    $be = $_POST['begins'];
    $en = $_POST['ends'];
    $dd = $_POST['devid'];
    
    $ud = mysqli_real_escape_string($conn, $ud);
    $be= mysqli_real_escape_string($conn, $be);
    $en = mysqli_real_escape_string($conn, $en);
    $dd = mysqli_real_escape_string($conn, $dd);
    
    $query = "INSERT INTO ". 
    "reserves (DEVICEID, USERID, BEGINS, ENDS ) ".
    "VALUES ('".$dd."', '".$ud."', '".$be."', '".$en."')";
    error_log("reserve: " .$query);
    $response = @mysqli_query($conn, $query);

    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        //header('Location: index.php');
        echo "onnistui";
        exit();
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
    }
}
?>