<?php
//session_start();
require_once 'laitinenConn.php';
if (isset($_POST['uname'])) { 
    error_log("insertUser onnistui ja post löytyi");
    $n = $_POST['name'];
    $ad = $_POST['address'];
    $un = $_POST['uname'];
    $pw = $_POST['password'];
    $ph = $_POST['phone'];
    $ia = 0;
    
    $pw = mysqli_real_escape_string($conn, $pw);
    $un = mysqli_real_escape_string($conn, $un);
    $n = mysqli_real_escape_string($conn, $n);
    $ad = mysqli_real_escape_string($conn, $ad);
    $ph = mysqli_real_escape_string($conn, $ph);
    
    $query = "INSERT INTO ". 
    "users (NAME, ADDRESS, USERNAME, PASSWORD, PHONE, ISADMIN) ".
    "VALUES ('".$n."', '".$ad."', '".$un."', '".$pw."', '".$ph."', '".$ia."')";
    error_log("Insert: " .$query);
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