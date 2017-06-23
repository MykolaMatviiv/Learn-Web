<?php
    if($_GET["country"] == 1) 
        echo json_encode(array("1" => "Vashington", "2" => "Sietl"));
    else if($_GET["country"] == 2) 
        echo json_encode(array("3" => "Paridg", "4" => "Marsel"));
?>