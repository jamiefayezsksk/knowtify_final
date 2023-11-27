<?php
// Include necessary files and initialize Firebase
include("config.php");
include("firebaseRDB.php");
include('sidebar.php');
$db = new firebaseRDB($databaseURL);

// Get the current month and year
$month = isset($_GET['month']) ? $_GET['month'] : date('n');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Get the selected day (if any)
$day = isset($_GET['day']) ? $_GET['day'] : null;

// Get the start and end dates for the week (if applicable)
$startOfWeek = isset($_GET['start']) ? $_GET['start'] : null;
$endOfWeek = isset($_GET['end']) ? $_GET['end'] : null;

// Get the first day of the month
$firstDay = strtotime("$year-$month-01");

// Get the number of days in the month
$numDays = date('t', $firstDay);

// Get the previous and next month and year
$prevMonth = date('n', strtotime('-1 month', $firstDay));
$prevYear = date('Y', strtotime('-1 month', $firstDay));
$nextMonth = date('n', strtotime('+1 month', $firstDay));
$nextYear = date('Y', strtotime('+1 month', $firstDay));

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
    <link rel="stylesheet" href="dash_style.css"> <!-- Link to the external CSS file -->
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

            <!-- Calendar -->

            <div class="content-container">
                <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">Previous Month</a>
                <span>
                    <?= date('F Y', $firstDay) ?>
                </span>
                <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">Next Month</a>
                <!-- Add Event Button -->
                <!-- Add buttons to view today, this week, and this month -->
                <button onclick="viewToday()">Today</button>
                <button onclick="viewThisWeek()">Week</button>
                <button onclick="viewThisMonth()">Month</button>
                <a href="#" class="add-event-btn" onclick="showEventForm()">Add Schedule</a>

                <table>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                    <tr>
                        <?php
                        // Fill in the blanks for the first week
                        for ($i = 0; $i < date('w', $firstDay); $i++) {
                            echo '<td></td>';
                        }

                        // Display the days of the month
                        for ($currentDay = 1; $currentDay <= $numDays; $currentDay++) {
                            $currentDate = strtotime("$year-$month-$currentDay");
                            // Add an event listener to each calendar cell
                            echo "<td onclick='addEvent(\"$year-$month-$currentDay\")'>";
                            echo "<div class='day-number'>$currentDay</div>";

                            // Display events for the current day
                            if (isset($events["$year-$month-$currentDay"])) {
                                foreach ($events["$year-$month-$currentDay"] as $event) {
                                    echo "<div class='event'>";
                                    echo "<div class='event-description'>{$event['description']}</div>";

                                    // Display additional appointment details
                                    echo "<div class='event-details'>";
                                    echo "<div><strong>Patient:</strong> {$event['patient']}</div>";
                                    echo "<div><strong>Time:</strong> {$event['time']}</div>";
                                    // Add more details as needed
                                    echo "</div>";

                                    echo "</div>";
                                }
                            }

                            echo "</td>";

                            // Start a new row every Sunday
                            if (date('w', $currentDate) == 6) {
                                echo '</tr><tr>';
                            }
                        }

                        // Fill in the blanks for the last week
                        for ($i = date('w', strtotime("$year-$month-$numDays")) + 1; $i <= 6; $i++) {
                            echo '<td></td>';
                        }
                        ?>
                    </tr>
                </table>

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

                    function viewToday() {
                        var today = new Date();
                        var currentMonth = today.getMonth() + 1;
                        var currentYear = today.getFullYear();
                        var currentDay = today.getDate();

                        window.location.href = '?month=' + currentMonth + '&year=' + currentYear + '&day=' + currentDay;
                    }

                    function viewThisWeek() {
                        var daysToShow = 7;
                        var startOfWeek = new
                            Date();
                        startOfWeek.setDate(startOfWeek.getDate() - daysToShow + 1);
                        window.location.href = '?view=week&start=' + formatDateString(startOfWeek) + '&end=' + formatDateString(new Date()) + '&days=' + daysToShow;
                    }

                    function viewThisMonth() {
                        viewCalendar('month');
                    }


                    // Added function to handle click on calendar cell
                    function addEvent(dateString) {
                        showEventForm(dateString);
                    }
                </script>
            </div>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3><a href="record.php">Patient Record</a></h3>

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