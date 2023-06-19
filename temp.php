<?php
    require_once("./php/config.php");

    $sql = "SELECT * FROM patients";

    $res = $db->query($sql);

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