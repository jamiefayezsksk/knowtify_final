<?php
// Include necessary files and initialize Firebase
include("config.php");
include("firebaseRDB.php");
include('doctor_sidebar.php');
$db = new firebaseRDB($databaseURL);



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['day']) && isset($_POST['event_description'])) {
        $day = $_POST['day'];
        $eventDescription = $_POST['event_description'];

        // Save event to Firebase
        $eventData = [
            'description' => $eventDescription,
            // Add any additional data you want to store
        ];

        // Form a unique key using the date and description
        $eventKey = "$year-$month-$day-" . md5($eventDescription);

        // Update or set the data in Firebase
        $db->insert("film/$eventKey", $eventData);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="dash_style.css"> <!-- Link to the external CSS file -->
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
</head>

<body>
    <?php
    $db = new firebaseRDB($databaseURL);
    ?>
    <div class="main-content">
        <main>
            <!-- calendar-->
            <div class="content-container">


                <a href="#" class="add-event-btn" onclick="showEventForm()">Add Schedule</a>

                <!-- FullCalendar -->
                <div id="calendar"></div>

                <!-- Event Form -->
                <div id="event-form-container" class="event-form">
                    <h3>Add Schedule</h3>
                    <form id="event-form" method="post" action="">
                        <label for="event-description">Event Description:</label>
                        <input type="hidden" id="selected-date" name="day" value="">
                        <input type="text" id="event-description" name="event_description" required>
                        <br>

                        <!-- Additional patient health record fields -->
                        <div class="form-group">
                            <label class="form-label" for="patient">Patient Name:</label>
                            <input class="form-input" type="text" name="patient">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="date_of_birth">Date of Birth:</label>
                            <input class="form-input" type="text" name="date_of_birth">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="gender">Gender:</label>
                            <input class="form-input" type="text" name="gender">
                        </div>

                        <!-- Add more patient health record fields as needed -->

                        <input type="submit" value="Save">
                        <a href="#" onclick="hideEventForm()">Cancel</a>
                    </form>
                </div>
                <!-- FullCalendar JavaScript -->
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

                <script>
                    $(document).ready(function () {
                        var calendar = $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Today',
                                month: 'Month',
                                week: 'Week',
                                day: 'Day'
                            },
                            events: function (start, end, timezone, callback) {
                                // Fetch events from your data source (replace this with your actual data source)
                                $.ajax({
                                    url: 'your_data_source.php',
                                    type: 'POST',
                                    dataType: 'json',
                                    success: function (response) {
                                        var events = [];
                                        // Process your data and populate 'events' array
                                        callback(events);
                                    }
                                });
                            },
                            // Handle event click
                            eventClick: function (calEvent, jsEvent, view) {
                                alert('Event: ' + calEvent.title);
                            }
                        });

                        // Function to show the event form
                        function showEventForm(dateString) {
                            // Implement your logic to show the form
                        }

                        // Function to hide the event form
                        function hideEventForm() {
                            // Implement your logic to hide the form
                        }

                        // Function to view today
                        function viewToday() {
                            calendar.fullCalendar('today');
                        }

                        // Function to view this week
                        function viewThisWeek() {
                            calendar.fullCalendar('changeView', 'agendaWeek');
                        }

                        // Function to view this month
                        function viewThisMonth() {
                            calendar.fullCalendar('changeView', 'month');
                        }
                    });
                </script>
            </div>
        </main>
    </div>


</body>

</html>