<?php
// Database connection settings
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'flight';

// Create a connection to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
}

// Prepare the SQL query to get the latest booking
$stmt = $conn->prepare("SELECT * FROM flight_bookings ORDER BY id DESC LIMIT 1");

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there is a result
if ($result->num_rows > 0) {
    // Start the HTML table
     echo "<html>
            <body>
                <style>
                    body {
                        background-image: url('booking.jpg'); /* Add background image */
                        background-size: cover; /* Cover the entire page */
                        background-position: center; /* Center the image */
                        background-attachment: fixed; /* Fix the image */
                        height: 100vh; /* Set the height to the full viewport */
                        margin: 0; /* Remove margin */
                        display: flex; /* Add flexbox to center the content */
                        justify-content: center; /* Center horizontally */
                        align-items: center; /* Center vertically */
                        text-align: center; /* Center the text */
                    }
                </style>
    <h2>Your Booking Details: </h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>To</th>
                <th>Departure Date</th>
                <th>Return Date</th>
                <th>Adults</th>
                <th>Children</th>
            </tr>";

    // Fetch the details and display them in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['from_location'] . "</td>
                <td>" . $row['to_location'] . "</td>
                <td>" . $row['departure_date'] . "</td>
                <td>" . $row['return_date'] . "</td>
                <td>" . $row['adults'] . "</td>
                <td>" . $row['children'] . "</td>
              </tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "No details found";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>