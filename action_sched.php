<?php
// Include configuration and Firebase class
include("config.php");
include("firebaseRDB.php");

// Initialize Firebase database
$db = new firebaseRDB($databaseURL);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['day']) && isset($_POST['event_description'])) {
        $day = $_POST['day'];
        $eventDescription = $_POST['event_description'];
        $patient = isset($_POST['patient']) ? $_POST['patient'] : "";
        $dateOfBirth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : "";
        $gender = isset($_POST['gender']) ? $_POST['gender'] : "";

        // Save event to Firebase
        $eventData = [
            'description' => $eventDescription,
            'patient' => $patient,
            'date_of_birth' => $dateOfBirth,
            'gender' => $gender,
            // Add any additional data you want to store
        ];

        // Form a unique key using the date and description
        $eventKey = $_POST['year'] . '-' . $_POST['month'] . '-' . $day . '-' . md5($eventDescription);

        // Update or set the data in Firebase
        $db->insert("film/$eventKey", $eventData);

        // Redirect back to the calendar after adding the event
        header("Location: calendar.php?month={$_POST['month']}&year={$_POST['year']}");
        exit;
    }
} else {
    // Handle non-POST requests or direct access to this file
    header("Location: index.php"); // Change this to the appropriate landing page
    exit;
}
?>