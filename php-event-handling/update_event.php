<?php
// Include the database configuration file to establish a connection
require_once("config.php");

// Check if all required POST parameters are set
if (isset($_POST['eventId']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['start']) && isset($_POST['end'])) {
    // Retrieve and assign the POST parameters to variables
    $eventId = $_POST['eventId'];
    $eventTitle = ucfirst($_POST['title']); // Capitalize the event title
    $eventDescription = ucfirst($_POST['description']); // Capitalize the event description
    $startDate = $_POST['start'];
    $endDate = $_POST['end'];

    // Define the SQL query to update the event with the given parameters
    $query = "UPDATE event_table SET event_title = ?, event_description = ?, start_date = ?, end_date = ? WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($query);

    // Bind the parameters to the SQL statement
    $stmt->bind_param("ssssi", $eventTitle, $eventDescription, $startDate, $endDate, $eventId);

    // Execute the SQL statement and check the result
    if ($stmt->execute()) {
        // If the update was successful, return a success response as JSON
        echo json_encode(["success" => true]);
    } else {
        // If there was an error during the update, return an error response as JSON
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Close the SQL statement
    $stmt->close();
} else {
    // If any required POST parameter is missing, return an error response as JSON
    echo json_encode(["success" => false, "error" => "Missing parameters"]);
}

// Close the database connection
$conn->close();
