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
    $tour_type = $_POST["tour-type"];
    $duration = $_POST["duration"];
    $budget = $_POST["budget"];

    // Prepare the SQL query
  $stmt = $conn->prepare("SELECT * FROM package_tours WHERE tour_type = ? AND duration = ? AND budget <= ?");
    $stmt->bind_param("ssi", $tour_type, $duration, $budget);
    // Execute the query
    if ($stmt->execute()) {
  // Redirect to booking_successful.php
  $result = $stmt->get_result();
        // Display the search results
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Tour Type</th>";
            echo "<th>Duration</th>";
            echo "<th>Budget</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['tour_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                echo "<td>" . htmlspecialchars($row['budget']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No tours found matching your criteria.";
        }
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
        <title>Tour Packages</title>
        <style>
            /* Global Styles */

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

a {
    text-decoration: none;
    color: #337ab7;
    /* Blue text */
}

a:hover {
    color: #23527c;
    /* Darker blue text on hover */
}

/* Package Tours Section Styles */

.package-tours-section {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.package-tours-section h2 {
    margin-top: 0;
}

.package-tours-section ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.package-tours-section li {
    margin-bottom: 10px;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.package-tours-section li:last-child {
    border-bottom: none;
}

/* Customize Tour Form Styles */

.customize-tour-form {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.customize-tour-form h2 {
    margin-top: 0;
}

.customize-tour-form label {
    display: block;
    margin-bottom: 10px;
}

.customize-tour-form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.customize-tour-form input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.customize-tour-form input[type="submit"] {
    background-color: #4CAF50;
    /* Green background */
    color: #fff;
    /* White text */
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.customize-tour-form input[type="submit"]:hover {
    background-color: #3e8e41;
    /* Darker green background on hover */
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
        <h1>Customize Your Tour</h1>
</header>
<main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <label for="tour-type">Tour Type:</label>
                <select id="tour-type" name="tour-type">
                    <option value="adventure">Adventure</option>
                    <option value="relaxation">Relaxation</option>
                    <option value="culture">Culture</option>
                </select><br><br>
                <label for="duration">Duration:</label>
                <select id="duration" name="duration">
                    <option value="3-days">3 Days</option>
                    <option value="5-days">5 Days</option>
                    <option value="7-days">7 Days</option>
                </select><br><br>
                <label for="budget">Budget:</label>
                <input type="number" id="budget" name="budget"><br><br>
                <input type="submit" value="Get Quote">  
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