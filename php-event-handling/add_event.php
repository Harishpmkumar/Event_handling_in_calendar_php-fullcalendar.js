<?php
// Include the database configuration file to establish a connection
require_once("config.php");

// Retrieve the event data from the POST request
$event_title = isset($_POST['title']) ? $_POST['title'] : null;
$event_description = isset($_POST['description']) ? $_POST['description'] : null;
$start_date = isset($_POST['start']) ? $_POST['start'] : null;
$end_date = isset($_POST['end']) ? $_POST['end'] : null;

// Capitalize the first letter of the event title and description
$event_title = ucfirst($event_title);
$event_description = ucfirst($event_description);

// Check if all required event data is provided
if ($event_title && $event_description && $start_date && $end_date) {
    // Prepare an SQL statement for inserting the event data into the database
    $stmt = $conn->prepare("INSERT INTO event_table (event_title, event_description, start_date, end_date) VALUES (?, ?, ?, ?)");

    // Bind the event data parameters to the SQL statement
    $stmt->bind_param("ssss", $event_title, $event_description, $start_date, $end_date);

    // Execute the SQL statement and check the result
    if ($stmt->execute()) {
        // If the event was inserted successfully, return a success response as JSON
        echo json_encode(["success" => true]);
    } else {
        // If there was an error inserting the event, return an error response as JSON
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Close the SQL statement
    $stmt->close();
} else {
    // If any required event data is missing, return an error response as JSON
    echo json_encode(["success" => false, "error" => "Missing required event data"]);
}

// Close the database connection
$conn->close();
