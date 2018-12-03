<?php
function getUser($conn)
{
// luodaan alasvetovalikko ja haetaan asiakastyypit siihen
    $query = "SELECT * from user where USERNAME=";
    $response = @mysqli_query($conn, $query);

    if ($response) { // jos kysely onnistui
        echo '<select name="categories"><option value=""></option>';
        while ($row = mysqli_fetch_array($response)) {
            echo '<option value="' . $row['ID'] . '">' .
                $row['NAME'] . '</option>';
        }
        echo '</select>';
    } else { // virheen sattuessa tulostetaan virheilmoitusta
        echo "<p style='color:red'>Virhe haettaessa dataa tietokannasta. Viesti: " . mysqli_error($conn) . "</p>";
    }
}
