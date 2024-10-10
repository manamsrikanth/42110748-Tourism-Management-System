<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$pickup_location = $_POST['pickup-location'];
$dropoff_location = $_POST['dropoff-location'];
$pickup_date = $_POST['pickup-date'];
$dropoff_date = $_POST['dropoff-date'];
$car_type = $_POST['car-type'];

// Insert the data into the database
$sql = "INSERT INTO car_rentals (pickup_location, dropoff_location, pickup_date, dropoff_date, car_type) VALUES ('$pickup_location', '$dropoff_location', '$pickup_date', '$dropoff_date', '$car_type')";

if (mysqli_query($conn, $sql)) {
    echo "Car rental data stored successfully!";
} else {
    echo "Error storing car rental data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>