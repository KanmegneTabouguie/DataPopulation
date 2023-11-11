<?php
// Database connection configuration.
$dbHost = '127.0.0.1';  // Use the local loopback address.
$dbUser = 'root';
$dbPass = 'yvan2021';
$dbName = 'e-commerce';

// Create a MySQLi database connection.
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check for a successful connection.
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function insertUserData($username, $password, $email, $first_name, $last_name, $phone_number, $registration_date) {
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO user (username, password, email, first_name, last_name, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssssss", $username, $password, $email, $first_name, $last_name, $phone_number, $registration_date);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>
