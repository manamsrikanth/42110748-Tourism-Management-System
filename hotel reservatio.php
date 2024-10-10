<?php
// Connect to database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$check_in = $_POST['check-in'];
$check_out = $_POST['check-out'];
$room_type = $_POST['room-type'];
$adults = $_POST['adults'];
$children = $_POST['children'];

// Insert data into database
$sql = "INSERT INTO reservations (check_in, check_out, room_type, adults, children) VALUES ('$check_in', '$check_out', '$room_type', '$adults', '$children')";
if (mysqli_query($conn, $sql)) {
    echo "Reservation made successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>