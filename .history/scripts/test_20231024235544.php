<?php
// Include your database connection script.
include('database.php'); // Replace with the actual file name.

// Check the MySQL connection.
if ($mysqli->ping()) {
    echo "Connected successfully!";
} else {
    echo "Connection failed: " . $mysqli->error;
}

// Close the MySQL connection.
$mysqli->close();
?>
