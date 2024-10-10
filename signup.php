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
}  else {
    echo "Connected to the database successfully!";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "Error: Passwords do not match";
        exit;
    }

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the query
    $result = $stmt->execute();

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