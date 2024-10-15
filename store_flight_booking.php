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
   $from = $_POST['from'];
    $to = $_POST['to'];
    $departure = $_POST['departure'];
    $return = $_POST['return'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];

    // Prepare the SQL query
 $stmt = $conn->prepare("INSERT INTO flight_bookings (from_location, to_location, departure_date, return_date, adults, children) VALUES (?, ?, ?, ?, ?, ?)");    // Bind the parameters
 $stmt->bind_param("ssssss", $from, $to, $departure, $return, $adults, $children);

    // Execute the query
    if ($stmt->execute()) {
  // Redirect to booking_successful.php
 header('Location: booking_successful.php');
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
        <title>Flight Booking</title>
        <style>
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
input[type="date"],
input[type="number"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 10px;
}

input[type="Book Now"] {
    background-color: #4CAF50;
    /* Green background */
    color: #fff;
    /* White text */
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

input[type="Book Now"]:hover {
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
</style>
</head>
<body>
    <header>
        <h1>Flight Booking</h1>
</header>
<main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="from">From:</label>
            <input type="text" id="from" name="from"><br><br>
            <label for="to">To:</label>
            <input type="text" id="to" name="to"><br><br>
            <label for="departure">Departure Date:</label>
            <input type="date" id="departure" name="departure"><br><br>
            <label for="return">Return Date:</label>
            <input type="date" id="return" name="return"><br><br>
            <label for="adults">Adults:</label>
            <input type="number" id="adults" name="adults"><br><br>
            <label for="children">Children:</label>
            <input type="number" id="children" name="children"><br><br>
            <input type="submit" value="Book Now">
        </form>
    </body>
</html>