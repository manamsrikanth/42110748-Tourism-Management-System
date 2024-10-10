<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$trip_type = $_POST['trip-type'];
$trip_duration = $_POST['trip-duration'];
$travelers = $_POST['travelers'];

// Insert the data into the database
$sql = "INSERT INTO travel_insurance (trip_type, trip_duration, travelers) VALUES ('$trip_type', '$trip_duration', '$travelers')";

if (mysqli_query($conn, $sql)) {
    echo "Travel insurance data stored successfully!";
} else {
    echo "Error storing travel insurance data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>