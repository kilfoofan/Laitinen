<?php
require 'laitinenConn.php';
//function getUser($username, $password, $conn)
//{
    if(isset($_GET["uname"])){
        error_log("GET löytyy");
        $uname = $_GET["uname"];
        $password = $_GET["password"];
    }
    error_log("täällä ollaan");
    //echo "<script>console.log('täällä ollaan');</script>";
    // oletuksena sql-kysely hakee kaikkien asiakkaiden tiedot
    $password = mysqli_real_escape_string($conn, $password);
    $uname = mysqli_real_escape_string($conn, $uname);
    $query = "SELECT * FROM users WHERE 1 = 1 ";
    if (!empty($username)) { // jos nimi-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= "AND USERNAME = '" . $uname . "'";
    }
    else{
        $query .= "AND USERNAME = 'notfound'"; 
    }
    if (!empty($password)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND PASSWORD = '" . $password . "'";
    }
    else{
        $query .= " AND PASSWORD = 'notfound'";
    }
    
    //$query = mysqli_real_escape_string($conn, $query);
    error_log($query);
    //error_log($query);
    $response = @mysqli_query($conn, $query);
    $result = [];
    if ($response) { // jos kysely onnistui
        //error_log(mysqli_fetch_array($response));
        while ($row = mysqli_fetch_array($response)) {
            //echo "<script>console.log($row);</script>";
            error_log("sql-onnistui: " .$row['name']);
            $result[] = $row;
            //echo "{uname: $row['uname'],address: $row['address'],phone: $row['phone'], isAdmin: $row['isadmin']}";
        }
    } else { // virheen sattuessa
        echo "<p style='color:red'>Virhe haettaessa dataa tietokannasta. Viesti: " . mysqli_error($conn) . "</p>";
    }
    echo json_encode($result);
    
//}
?>