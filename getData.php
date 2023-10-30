<?php

require_once 'functions.php';

if(isset($_GET['did'])) {
    $devices = query("SELECT * FROM devices WHERE id = " . $_GET['did'])[0];    
} else {
    $devices = query("SELECT * FROM devices WHERE users_id = " . $_GET['uid'])[0];
}

// var_dump($devices);die;
$result = [
    "inputs" => query("SELECT * FROM inputs WHERE devices_id = " . $devices['id']),
    "schedules" => query("SELECT * FROM schedules WHERE devices_id = " . $devices['id'] . " ORDER BY datetime"),
    "sensors" => explodeSensor(query("SELECT * FROM data_sensors WHERE devices_id = " . $devices['id'] . " ORDER BY id DESC")),
];

// var_dump($devices);die;
header("Content-Type: application/json");
echo json_encode($result);