<?php
// Configuration
$dbhost = "localhost";
$dbname = "gotrip";
$dbuser = "root";
$dbpass = "";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert user data into database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = $conn->query($sql);

    if ($result) {
        // User data stored successfully, redirect to dashboard
        header("Location: dashboard.html");
        exit;
    } else {
        // Error storing user data, display error message
        echo "Error storing user data: " . $conn->error;
    }
}

$conn->close();
?>