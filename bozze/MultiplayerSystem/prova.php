<?php
// Read the raw POST data from the input stream
$rawData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($rawData, true);

// Create an object to save into the file
$myObj = new stdClass();
$myObj->timestamp = $data['timestamp'];
$myObj->event = $data['event'];

// Encode the object into JSON
$myJSON = json_encode($myObj);

// Write the JSON to a file
file_put_contents('prova.json', $myJSON);
?>