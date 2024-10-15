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
    echo "Connected to database successfully\n";
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $budget = $_POST["budget"];

    echo "Form data: budget = '$budget'\n";

    // Prepare the SQL query to retrieve package tours based on user input
    $stmt = $conn->prepare("SELECT * FROM package_tours WHERE budget <= ?");
    $stmt->bind_param("i", $budget);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Query: SELECT * FROM package_tours WHERE budget <= '$budget'\n";

    // Display the search results
    if ($result->num_rows > 0) {
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Tour Name</th>";
        echo "<th>Tour Type</th>";
        echo "<th>Duration</th>";
        echo "<th>Budget</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tour_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tour_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
            echo "<td>" . htmlspecialchars($row['budget']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No tours found matching your criteria.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>