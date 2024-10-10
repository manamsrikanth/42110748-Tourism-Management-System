<?php
// Connect to database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$tour_type = $_POST['tour-type'];
$duration = $_POST['duration'];
$budget = $_POST['budget'];

// Insert data into database
$sql = "INSERT INTO package_tours (tour_type, duration, budget) VALUES ('$tour_type', '$duration', '$budget')";
if (mysqli_query($conn, $sql)) {
    echo "Package tour created successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>