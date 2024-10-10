<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$from = $_POST['from'];
$to = $_POST['to'];
$departure = $_POST['departure'];
$return = $_POST['return'];
$adults = $_POST['adults'];
$children = $_POST['children'];

// Prepare the SQL statement
$stmt = mysqli_prepare($conn, "INSERT INTO flight_bookings (from, to, departure, return, adults, children) VALUES (?, ?, ?, ?, ?, ?)");

// Bind the parameters
mysqli_stmt_bind_param($stmt, "ssssii", $from, $to, $departure, $return, $adults, $children);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check if the data was stored successfully
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Flight booking data stored successfully!";
} else {
    echo "Error storing flight booking data: " . mysqli_stmt_error($stmt);
}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>