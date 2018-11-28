<?php
require ('laitinenConn.php');
//function getCategories($conn)
//{
// luodaan alasvetovalikko ja haetaan asiakastyypit siihen
    $query = "SELECT name, shortname from categories";
    $response = @mysqli_query($conn, $query);
    error_log("getCategories: " .$query);
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
    //$testi = json_encode($result);
    //error_log("results: ".$testi);
    echo json_encode($result);
//}
