<?php
//session_start();
require_once 'laitinenConn.php';
if (isset($_GET['uname'])) { // jos lisäysdialogin tallenna-nappia on painettu
    error_log("updateUser onnistui ja post löytyi");
    $n = $_GET['name'];
    $ad = $_GET['address'];
    $un = $_GET['uname'];
    $pw = $_GET['password'];
    $ph = $_GET['phone'];
    $ia = 0;
    
    $pw = mysqli_real_escape_string($conn, $pw);
    $un = mysqli_real_escape_string($conn, $un);
    $n = mysqli_real_escape_string($conn, $n);
    $ad = mysqli_real_escape_string($conn, $ad);
    $ph = mysqli_real_escape_string($conn, $ph);
    //tähän if-lausekkeet, että tyhjiä kenttiä ei viedä kantaan
    $query = "UPDATE ". 
    "users ".
    "SET name='".$n."', address='".$ad."', password='".$pw."', phone='".$ph."' ".
    "WHERE username='".$un."'";
    error_log("Insert: " .$query);
    $response = @mysqli_query($conn, $query);
    $result = [];
    if ($response) { // Jos kysely onnistui, palataan aloitussivulle siten, että parametreina ovat $_SESSION[]-muuttujiin tallennetut hakuehdot
        $query = "SELECT * FROM users WHERE 1 = 1 AND username='".$un."'";
        error_log("update requery: '".$query)."'";
        $response = @mysqli_query($conn, $query);
        /*$test = mysqli_fetch_array($response);
        //$result[] = $test;
        error_log("update requery result: ".$test['name'].$test['phone']);
        */
        if($response) {
            //$test = mysqli_fetch_array($response);
            //error_log("update requery result2: ".$test['name']);
            while ($row = mysqli_fetch_array($response)) {
                error_log("update requery result3: ".$row['name']);
                //echo "<script>console.log($row);</script>";
                error_log("sql-onnistui: " .$row['name']);
                $result[] = $row;
                //echo "{uname: $row['uname'],address: $row['address'],phone: $row['phone'], isAdmin: $row['isadmin']}";
            }
        }
        else {
            echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red'>Virhe lisättäessä dataa tietokantaan. Viesti: " . mysqli_error($conn) . "</p>";
    }
    echo json_encode($result);
}
?>