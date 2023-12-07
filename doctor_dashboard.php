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
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="dash_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            background-color: #008543;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-welcome,
        .search-wrapper,
        .social-icons {
            display: flex;
            align-items: center;
        }

        .user-welcome span,
        .search-wrapper input,
        .social-icons span {
            margin-right: 1px;
        }

        main {
            flex: 1;
            padding: 10px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .user-profile span {
            width: 50px;
            height: 50px;
            background-color: #008543;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dash-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .dash-cards {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-single {
            flex: 1;
            margin-right: 20px;
            background-color: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .card-body span {
            font-size: 36px;
            margin-right: 10px;
        }

        .card-footer {
            background-color: #008543;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .card-footer a {
            color: white;
            text-decoration: none;
        }

        .content-container {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #008543;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .event-form {
            display: none;
            position: absolute;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .recent {
            display: flex;
            justify-content: space-between;
        }

        .activity-card {
            flex: 1;
            background-color: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 20px;
        }

        .table-responsive {
            overflow-y: auto;
        }

        .small-calendar {
            background-color: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-basis: 30%;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <header>
            <div class="user-welcome">
                <span>Welcome, Doctor!</span>
            </div>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>
            <div class="social-icons">
                <span class="ti-bell"></span>
                <div></div>
            </div>
        </header>
        <main>
            <div class="user-profile">
                <span class="profile"></span>
                <span class="name"></span>
                <div></div>
            </div>
            <h2 class="dash-title">Overview</h2>

            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Appointments</h5>
                            <h4>10+ patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-reload"></span>
                        <div>
                            <h5>Pending</h5>
                            <h4>3 patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-check-box"></span>
                        <div>
                            <h5>Processed</h5>
                            <h4>2 patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>
            </div>

            <!-- FullCalendar -->
            <div id="calendar"></div>

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

            <div id="overlay" class="overlay"></div>

            <script>
                function showEventForm(dateString) {
                    var formContainer = document.getElementById('event-form-container');
                    var overlay = document.getElementById('overlay');
                    var selectedDateInput = document.getElementById('selected-date');

                    if (dateString) {
                        selectedDateInput.value = dateString;
                    }

                    formContainer.style.display = 'block';
                    overlay.style.display = 'block';
                }

                function hideEventForm() {
                    var formContainer = document.getElementById('event-form-container');
                    var overlay = document.getElementById('overlay');
                    formContainer.style.display = 'none';
                    overlay.style.display = 'none';
                }


                // Added function to handle click on calendar cell
                function addEvent(dateString) {
                    showEventForm(dateString);
                }
            </script>

            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3><a href="doctor_record.php">Patient Record</a></h3>

                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th>Patient Information</th>
                                    <th>Visit</th>
                                    <th>History</th>
                                    <th>Diagnosis</th>
                                    <th>Upcoming Appointments</th>
                                    <th>Doctor's Notes</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                <?php
                                $data = $db->retrieve("film");
                                $data = json_decode($data, true);

                                if (is_array($data)) {
                                    foreach ($data as $id => $film) {
                                        $patient = isset($film['patient']) ? $film['patient'] : '';
                                        $visit = isset($film['visit']) ? $film['visit'] : '';
                                        $history = isset($film['history']) ? $film['history'] : '';
                                        $diagnosis = isset($film['diagnosis']) ? $film['diagnosis'] : '';
                                        $appointment = isset($film['appointment']) ? $film['appointment'] : '';
                                        $notes = isset($film['notes']) ? $film['notes'] : '';

                                        echo "<tr>
                                            <td><a href='name.php?id=$id'>$patient</a></td>
                                            <td>$visit</td>
                                            <td>$history</td>
                                            <td>$diagnosis</td>
                                            <td>$appointment</td>
                                            <td>$notes</td>
                                            <td><a href='edit.php?id=$id'>EDIT</a></td>
                                            <td><a href='delete.php?id=$id'>DELETE</a></td>
                                            </tr>";
                                    }
                                }
                                ?>
                            </table>
                            <a href="add.php"><button>ADD DATA</button></a><br><br>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="right-side">
        <?php include('appointment.php'); ?>

        <!-- Small calendar to reflect events -->
        <div class="small-calendar">
            <!-- ... (your small calendar content remains unchanged) ... -->
        </div>
    </div>
</body>

</html>