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
    $pickup_location = $_POST["pickup-location"];
    $dropoff_location = $_POST["dropoff-location"];
    $pickup_date = $_POST["pickup-date"];
    $dropoff_date = $_POST["dropoff-date"];
    $car_type = $_POST["car-type"];
    // Prepare the SQL query
 $stmt = $conn->prepare("INSERT INTO car_rental (pickup_location, dropoff_location, pickup_date, dropoff_date, car_type) VALUES (?, ?, ?, ?, ?)"); 
 $stmt->bind_param("sssss", $pickup_location, $dropoff_location, $pickup_date, $dropoff_date, $car_type);
    // Execute the query
    if ($stmt->execute()) {
  // Redirect to booking_successful.php
 header('Location: car_booking_successful.php');
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
        <title>Car Rental</title>
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

input[type="text"],
input[type="date"] {
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

/* Car Rental Form Styles */

.car-rental-form {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.car-rental-form h2 {
    margin-top: 0;
}

.car-rental-form label {
    display: block;
    margin-bottom: 10px;
}

.car-rental-form input[type="text"],
.car-rental-form input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.car-rental-form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.car-rental-form input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.car-rental-form input[type="submit"]:hover {
    background-color: #3e8e41;
}

/* Available Cars List Styles */

.available-cars {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


</style>
</head>
<body>
    <header>
        <h1>Flight Booking</h1>
</header>
<main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="pickup-location">Pickup Location:</label>
            <input type="text" id="pickup-location" name="pickup-location"><br><br>
            <label for="dropoff-location">Dropoff Location:</label>
            <input type="text" id="dropoff-location" name="dropoff-location"><br><br>
            <label for="pickup-date">Pickup Date:</label>
            <input type="date" id="pickup-date" name="pickup-date"><br><br>
            <label for="dropoff-date">Dropoff Date:</label>
            <input type="date" id="dropoff-date" name="dropoff-date"><br><br>
            <label for="car-type">Car Type:</label>
            <select id="car-type" name="car-type">
                <option value="economy">Economy</option>
                <option value="compact">Compact</option>
                <option value="mid-size">Mid-size</option>
                <option value="full-size">Full-size</option>
                <option value="luxury">Luxury</option>
                <option value="suv">SUV</option>
                <option value="truck">Truck</option>
                <option value="van">Van</option>
                <option value="minivan">Minivan</option>
                <option value="convertible">Convertible</option>
                <option value="coupe">Coupe</option>
                <option value="wagon">Wagon</option>
            </select><br><br>
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