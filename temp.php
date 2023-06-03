<?php
    require_once("./php/dbConnection.php");

    $sql = "SELECT * FROM patients";

    $res = $mysqli->query($sql);

    // print_r($res);

    $row = $res->fetch_assoc();

    while($row){
        // print_r($row);
        echo "<a href=\"\">".$row['patient_fname']."</a>";
        $row = $res->fetch_assoc();
        echo "<br><br>";
    }

    $mysqli->close();
?>