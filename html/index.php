<?php
require_once "inc/init.php";

$database = new Database();
$api = new ApiTelSearch();

echo "<h1>Clearing the database</h1>";
$database->clearDatabase();

echo "<h1>Getting and inserting the vets</h1>";
$api->insertAllVets();

echo "<h1>Displaying the vets</h1>";
$database->displayAllVets();

?>
