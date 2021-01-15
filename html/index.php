<?php
require_once "inc/init.php";

$database = new Database();
$api = new ApiTelSearch();
$database->clearDatabase();
$api->insertAllVets();

include "head.html";
include "body.html";
include "footer.html";


//$database->displayAllVets();

?>
