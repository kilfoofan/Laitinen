<?php
//session_start();
require_once 'laitinenConn.php';
if (isset($_GET['save'])) { // jos lisäysdialogin tallenna-nappia on painettu
    error_log("updateUser onnistui ja post löytyi");
    $id = $_GET["id"];
    $na = $_GET['name'];
    $mo = $_GET['model'];
    $ma = $_GET['make'];
    $de = $_GET['description'];
    $lo = $_GET['location'];
    $ow = $_GET['owner'];
    $cg = $_GET['category'];
    $sn = $_GET["serial"];
    $ia = 0;
    
    $id = mysqli_real_escape_string($conn, $id);
    $na = mysqli_real_escape_string($conn, $na);
    $mo = mysqli_real_escape_string($conn, $mo);
    $ma = mysqli_real_escape_string($conn, $ma);
    $de = mysqli_real_escape_string($conn, $de);
    $lo = mysqli_real_escape_string($conn, $lo);
    $ow = mysqli_real_escape_string($conn, $ow);
    $cg = mysqli_real_escape_string($conn, $cg);
    $sn = mysqli_real_escape_string($conn, $sn);
    //tähän if-lausekkeet, että tyhjiä kenttiä ei viedä kantaan
    $query = "UPDATE ". 
    "device ".
    "SET name='".$na."', model='".$mo."', make='".$ma.
    "', description='".$de."', location='".$lo."', owner='".$ow.
    "', category='".$cg."', serial='".$sn."' ".
    "WHERE id='".$id."'";
    error_log("edit: " .$query);
    $response = @mysqli_query($conn, $query);
    $result = [];
    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
    }
    //echo json_encode($result);
}else if(isset($_GET["setRem"])){
    $setRem = $_GET["setRem"];
    $id = $_GET["id"];

    $id = mysqli_real_escape_string($conn, $id);
    $setRem = mysqli_real_escape_string($conn, $setRem);

    $query = "UPDATE ". 
    "device ".
    "SET remove='".$setRem."' ".
    "WHERE id='".$id."'";
    error_log("edit: " .$query);
    $response = @mysqli_query($conn, $query);
    $result = [];
    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
    }
    //echo json_encode($result);
}else if(isset($_GET["setRes"])){
    $setRes = $_GET["setRes"];
    $id = $_GET["id"];

    $id = mysqli_real_escape_string($conn, $id);
    $setRes = mysqli_real_escape_string($conn, $setRes);

    $query = "UPDATE ". 
    "device ".
    "SET isReserved='".$setRes."', Reservations = Reservations + 1 ".
    "WHERE id='".$id."'";
    error_log("edit: " .$query);
    $response = @mysqli_query($conn, $query);
    $result = [];
    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
    }
    //echo json_encode($result);
}

?>