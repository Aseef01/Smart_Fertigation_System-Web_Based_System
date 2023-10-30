<?php

// Global configuration
session_start();
ob_start();

// Setup Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot-platform";

// $servername = "127.0.0.1";
// $username = "forotify_aseef";
// $password = "@Ryuunosuke7190";
// $dbname = "forotify_iot_platfom";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get Data
function query($query) {
    global $conn;
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        $rows = [];
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    return "Data is not available!";
}

function updateData($query) {
    global $conn;
    if ($conn->query($query) === TRUE) {
        return "Record updated successfully";
      } else {
        return "Error updating record: " . $conn->error;
      }
}

// Explode Array Data Sensor
function explodeSensor($sensors) {
    if(!is_array($sensors)) {
        return $sensors;
    }
    $data_sensors = [];
    foreach(json_decode($sensors[0]['data']) as $key => $value) {
        $data_sensors[] = ["name" => $key, "value" => $value, "unit" => ""];   
    }
    return $data_sensors;
}

function validate($data) {
    $email = $data['email'];
    $password = $data['password'];

    $user = query("SELECT * FROM users WHERE email = '$email'");

    if(is_string($user)) {
        return $error = 'Invalid username or password.';
    }

    if(!password_verify($password, $user[0]['password'])) {
        return $error = 'Invalid username or password.';   
    }
    
    // if($user[0]["roles"] != "admin") {
    //     return $error = 'Sorry, only admin can login';   
    // }

    $name = explode(' ', $user[0]["full_name"]);
    // setcookie('user', $name[0] . " " . $name[1], time() + 3600, '/');
    // setcookie('user', $name[0] . " " . $name[1]);
    // setcookie('roles', $user[0]["roles"]);
    // setcookie('aid', $user[0]["id"]);

    $_SESSION['user'] = $name[0] . " " . $name[1];
    $_SESSION['roles'] = $user[0]["roles"];
    $_SESSION['aid'] = $user[0]["id"];

    if($user[0]["roles"] != "admin") {
        header('Location: device.php?uid=' . $_SESSION['aid']);
        exit();
    }
    header('Location: user_management_page.php');
    exit();
}