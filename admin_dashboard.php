<?php
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

// Get the number of days to view for the weekly view
$daysToShow = isset($_GET['days']) ? intval($_GET['days']) : 1;

// Calculate the start and end dates for the weekly view
$startOfWeek = isset($_GET['start']) ? $_GET['start'] : null;
$endOfWeek = isset($_GET['end']) ? $_GET['end'] : null;

if (!$startOfWeek && !$endOfWeek && $daysToShow > 1) {
    // If no start or end date is specified for the week, and it's a weekly view
    // Calculate the start and end of the week based on the number of days to show
    $startOfWeek = date('Y-m-d', strtotime("-{$daysToShow} days"));
    $endOfWeek = date('Y-m-d');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
</head>

<body>
    <?php
    include("config.php");
    include("firebaseRDB.php");
    include('sidebar.php');
    $db = new firebaseRDB($databaseURL);
    ?>
    <div class="main-content">
        <header>
            <div class="user-welcome">
                <span>Welcome, Admin!
                </span>
            </div>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
                <div class="search-overlay" id="search-overlay"></div>
            </div>
            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
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

            <!-- calendar-->

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

                    function viewCalendar(type) {
                        var today = new Date();
                        var currentMonth = today.getMonth() + 1; // Months are zero-indexed
                        var currentYear = today.getFullYear();

                        switch (type) {
                            case 'today':
                                window.location.href = '?month=' + currentMonth + '&year=' + currentYear + '&day=' + today.getDate();
                                break;
                            case 'week':
                                // Calculate the start and end of the week
                                var startOfWeek = new Date(today);
                                startOfWeek.setDate(today.getDate() - today.getDay());
                                var endOfWeek = new Date(today);
                                endOfWeek.setDate(today.getDate() - today.getDay() + 6);
                                window.location.href = '?view=week&start=' + startOfWeek.toISOString().slice(0, 10) + '&end=' + endOfWeek.toISOString().slice(0, 10);
                                break;
                            case 'month':
                                window.location.href = '?month=' + currentMonth + '&year=' + currentYear;
                                break;
                            default:
                                break;
                        }
                    }

                    function viewCalendar(type) {
                        var today = new Date();
                        var currentMonth = today.getMonth() + 1; // Months are zero-indexed
                        var currentYear = today.getFullYear();

                        switch (type) {
                            case 'today':
                                window.location.href = '?month=' + currentMonth + '&year=' + currentYear + '&day=' + today.getDate();
                                break;
                            case 'week':
                                // Specify the number of days to view for the weekly view
                                var daysToShow = 7;
                                // Calculate the start date based on the number of days to show
                                var startOfWeek = new Date(today);
                                startOfWeek.setDate(today.getDate() - daysToShow + 1);
                                window.location.href = '?view=week&start=' + formatDateString(startOfWeek) + '&end=' + formatDateString(today) + '&days=' + daysToShow;
                                break;
                            case 'month':
                                window.location.href = '?month=' + currentMonth + '&year=' + currentYear;
                                break;
                            default:
                                break;
                        }
                    }

                    function formatDateString(date) {
                        // Helper function to format the date as 'YYYY-MM-DD'
                        return date.toISOString().slice(0, 10);
                    }

                    /// Event handlers for the buttons
                    function viewToday() {
                        var today = new Date();
                        var currentMonth = today.getMonth() + 1;
                        var currentYear = today.getFullYear();
                        var currentDay = today.getDate();

                        window.location.href = '?month=' + currentMonth + '&year=' + currentYear + '&day=' + currentDay;
                    }

                    function viewThisWeek() {
                        // Specify the number of days to view for the weekly view
                        var daysToShow = 7;
                        // Calculate the start date based on the number of days to show
                        var startOfWeek = new Date();
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


                <section class="recent">
                    <div class="activity-grid">
                        <div class="activity-card">
                            <h3><a href="record.php">Patient Record</a></h3>

                            <div class="table-responsive">
                                <table border="1" width="500">
                                    <tr align="center" bgcolor="#028960" ;>
                                        <td>Patient Information</td>
                                        <td>Visit</td>
                                        <td>History</td>
                                        <td>Diagnosis</td>
                                        <td>Upcoming Appointments</td>
                                        <td>Doctor's Notes</td>
                                        <td colspan="3">Action</td>
                                    </tr>
                                    <?php
                                    $data = $db->retrieve("film");
                                    $data = json_decode($data, 1);

                                    if (is_array($data)) {
                                        foreach ($data as $id => $film) {
                                            echo "<tr>
                                        <td><a href='name.php?id=$id'>{$film['patient']}</a></td>
                                        <td>{$film['visit']}</td>
                                        <td>{$film['history']}</td>
                                        <td>{$film['diagnosis']}</td>
                                        <td>{$film['appointment']}</td>
                                        <td>{$film['notes']}</td>
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

                        <div class="summary">
                            <div class="summary-card">
                                <div class="summary-single">
                                    <span class="ti-id-badge"></span>
                                    <div>
                                        <h5>196</h5>
                                        <small>Number of Patients</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>16</h5>
                                        <small>Schedule ni doc</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-face-smile"></span>
                                    <div>
                                        <h5>12</h5>
                                        <small>Profile update request</small>
                                    </div>
                                </div>
                            </div>

                            <div class="bday-card">
                                <div class="bday-flex">
                                    <div class="bday-img"></div>
                                    <div class="bday-info">
                                        <h5>Dwayne F. Sanders</h5>
                                        <small>Upcoming Surgery</small>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button>
                                        <span class="ti-gift"></span>
                                        Prioritize patient
                                    </button>
                                </div>
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
            <h3>Events Calendar</h3>
            <!-- Add your small calendar content here -->
            <!-- For example, display events for the current month -->
        </div>
    </div>

</body>

</html>