<?php

require_once 'functions.php';

$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

if($data['title'] == "swith_button") {
    // var_dump($name);die;

    // $title = $data['title'];
    // $name = $data['name'];
    $id = $data['id'];
    $value = ($data['value'] == 1) ? 0 : 1;

    $hasil = updateData("UPDATE inputs SET status = $value WHERE id = $id");
} else if($data['title'] == "remove_schedule") {
    $hasil = updateData("DELETE FROM schedules WHERE id = " . $data['id']);
} else if($data['title'] == "remove_user") {
    $hasil = updateData("DELETE FROM users WHERE id = " . $data['id']);
}

$result = [
    "title" => $hasil
];

header("Content-Type: application/json");
echo json_encode($result);