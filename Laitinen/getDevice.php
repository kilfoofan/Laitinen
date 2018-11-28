<?php
require 'laitinenConn.php';
//function getUser($username, $password, $conn)
//{
    //error_log("getDevice ollaan");
    error_log("save:" .$_GET["save"]);
    if(isset($_GET["save"])){
        error_log("GET löytyy");
        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }
        if(isset($_GET["name"])){
            $na = $_GET["name"];
        }
        if(isset($_GET["model"])){
            $md = $_GET["model"];
        }
        if(isset($_GET["make"])){
            $mk = $_GET["make"];
        }
        if(isset($_GET["owner"])){
            //$de = $_GET["description"];
            $ow = $_GET["owner"];
        }
        if(isset($_GET["category"])){
            $cg = $_GET["category"];
        }
        if(isset($_GET["location"])){
            $lo = $_GET["location"];
        }
        if(isset($_GET["serial"])){
            $sn = $_GET["serial"];
        }
    }
    error_log("getDevices täällä ollaan");
    //echo "<script>console.log('täällä ollaan');</script>";
    // oletuksena sql-kysely hakee kaikkien asiakkaiden tiedot
    /*
    if(isset($mk)){$mk = mysqli_real_escape_string($conn, $mk);}
    if(isset($mk)){$na = mysqli_real_escape_string($conn, $na);}
    if(isset($mk)){$md = mysqli_real_escape_string($conn, $md);}
    //if(isset($mk)){$de = mysqli_real_escape_string($conn, $de);}
    if(isset($mk)){$ow = mysqli_real_escape_string($conn, $ow);}
    if(isset($mk)){$lo = mysqli_real_escape_string($conn, $lo);}
    if(isset($mk)){$sn = mysqli_real_escape_string($conn, $sn);}
    if(isset($mk)){$cg = mysqli_real_escape_string($conn, $cg);}
*/
    $query = "SELECT * FROM device WHERE 1 = 1 ";
    if (!empty($id)) { // jos nimi-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= "AND ID = '" . $id . "'";
    }
    if (!empty($na)) { // jos nimi-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= "AND NAME = '" . $na . "'";
    }
    if (!empty($mk)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND MAKE = '" . $mk . "'";
    }
    if (!empty($md)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND MODEL = '" . $md . "'";
    }
    /*if (!empty($de)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND DESCRIPTION = '" . $de . "'";
    }*/
    if (!empty($cg)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND CATEGORY = '" . $cg . "'";
    }
    if (!empty($lo)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND LOCATION = '" . $lo . "'";
    }
    if (!empty($ow)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND OWNER = '" . $ow . "'";
    }
    if (!empty($sn)) { // jos osoite-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= " AND SERIAL = '" . $sn . "'";
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
    $test = json_encode($result);
    error_log("results: ".$test);
    echo json_encode($result);
    
//}
?>