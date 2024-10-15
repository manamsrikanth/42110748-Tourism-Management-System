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
} 

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $check_in = $_POST["check-in"];
    $check_out = $_POST["check-out"];
    $room_type = $_POST["room-type"];
    $adults = $_POST["adults"];
    $children = $_POST["children"];

    // Prepare the SQL query
  $stmt = $conn->prepare("INSERT INTO hotel_bookings (check_in, check_out, room_type, adults, children) VALUES (?, ?, ?, ?, ?)");
 $stmt->bind_param("sssss", $check_in, $check_out, $room_type, $adults, $children);

    // Execute the query
    if ($stmt->execute()) {
  // Redirect to booking_successful.php
 header('Location: hotel_booking_successful.php');
         exit;
        } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML form to collect user input -->
<html>
    <body>
        <title>Hotel Booking</title>
        <style>
            /* Global Styles */

/* Global Styles */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    /* Light gray background */
}

header {
    background-color: #333;
    /* Dark gray background */
    color: #fff;
    /* White text */
    padding: 1em;
    text-align: center;
}

header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
}

header nav ul li {
    margin-right: 20px;
}

header nav a {
    color: #fff;
    text-decoration: none;
}

header nav a:hover {
    color: #ccc;
    /* Light gray text on hover */
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2em;
}

h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Light gray shadow */
}

label {
    margin-bottom: 10px;
}

input[type="date"],
input[type="number"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 10px;
}

select {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    /* Green background */
    color: #fff;
    /* White text */
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
    /* Darker green background on hover */
}

section {
    margin-bottom: 20px;
}

h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

footer {
    background-color: #333;
    /* Dark gray background */
    color: #fff;
    /* White text */
    padding: 1em;
    text-align: center;
    clear: both;
}

/* Hotel Reservation Form Styles */

.hotel-reservation-form {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hotel-reservation-form h2 {
    margin-top: 0;
}

.hotel-reservation-form label {
    display: block;
    margin-bottom: 10px;
}

.hotel-reservation-form input[type="date"],
.hotel-reservation-form input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.hotel-reservation-form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.hotel-reservation-form input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.hotel-reservation-form input[type="submit"]:hover {
    background-color: #3e8e41;
}

/* Available Hotels List Styles */

.available-hotels {
    width: 80%;
    margin: 40px auto;
    padding: ⬤
}
</style>
</head>
<body>
    <header>
        <h1>Flight Booking</h1>
</header>
<main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="check-in">Check-in Date:</label>
            <input type="date" id="check-in" name="check-in"><br><br>
            <label for="check-out">Check-out Date:</label>
            <input type="date" id="check-out" name="check-out"><br><br>
            <label for="room-type">Room Type:</label>
            <select id="room-type" name="room-type">
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
            </select><br><br>
            <label for="adults">Number of Adults:</label>
            <input type="number" id="adults" name="adults"><br><br>
            <label for="children">Number of Children:</label>
            <input type="number" id="children" name="children"><br><br>
            <input type="submit" value="Book Now">
        </form>
         <?php
        // Display the bookings table
        ?>
        
    </main>
    <footer>
        <p>&copy; 2024 Tourism Management System</p>
    </footer>
    </body>
</html>