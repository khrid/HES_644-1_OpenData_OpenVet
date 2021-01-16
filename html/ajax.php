<?php

require_once "inc/init.php";
if(isset($_GET["target"])) {
    $target = $_GET["target"];
    switch($target) {
        case "vetstojson":
            $database = new Database();
            echo $database->vetsToJson();
            break;
    }
}
