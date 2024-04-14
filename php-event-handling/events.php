<?php
// Include the database configuration file to establish a connection
require_once("config.php");

// Define the query to select event data from the event_table
$query = "SELECT id, event_title, event_description, start_date, end_date FROM event_table";

// Execute the query and store the result in the $result variable
$result = $conn->query($query);

// Initialize an array to store the events data
$events = [];

// Check if the query returned any rows
if ($result && $result->num_rows > 0) {
    // Iterate through each row in the result set
    while ($row = $result->fetch_assoc()) {
        // Create an associative array for each event with its details
        $event = [
            "id" => $row["id"],
            "title" => $row["event_title"],
            "description" => $row["event_description"],
            "start" => $row["start_date"],
            "end" => $row["end_date"],
        ];
        // Add the event array to the events array
        $events[] = $event;
    }
}

// Close the result set
$result->close();

// Set the response content type to JSON
header("Content-Type: application/json");

// Encode the events array as JSON and output it
echo json_encode($events);

// Close the database connection
$conn->close();
