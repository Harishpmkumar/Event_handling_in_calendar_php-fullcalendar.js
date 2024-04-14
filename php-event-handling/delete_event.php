<?php

// Include the database configuration file to establish a connection
require_once("config.php");

// Check if the 'eventId' parameter is set in the POST request
if (isset($_POST['eventId'])) {
    // Retrieve the event ID and convert it to an integer
    $eventId = intval($_POST['eventId']);

    // Define the SQL query to delete an event with the specified ID
    $query = "DELETE FROM event_table WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($query);

    // Bind the event ID parameter to the SQL statement
    $stmt->bind_param("i", $eventId);

    // Execute the SQL statement and check the result
    if ($stmt->execute()) {
        // If the deletion was successful, return a success response as JSON
        echo json_encode(["success" => true]);
    } else {
        // If there was an error during deletion, return an error response as JSON
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Close the SQL statement
    $stmt->close();
} else {
    // If the 'eventId' parameter is missing, return an error response as JSON
    echo json_encode(["success" => false, "error" => "Missing eventId parameter"]);
}

// Close the database connection
$conn->close();
