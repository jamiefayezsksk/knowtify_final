<?php
// Function to get the dashboard link based on user role
function getDashboardLink($currentPage)
{
    // Replace the condition with your actual logic to determine the user's role
    $userRole = 'doctor'; // Example: Replace with the actual user role

    switch ($userRole) {
        case 'admin':
            return ($currentPage === 'admin_dashboard.php') ? '#' : 'admin_dashboard.php';
        case 'doctor':
            return ($currentPage === 'doctor_dashboard.php') ? '#' : 'doctor_dashboard.php';
        case 'secretary':
            return ($currentPage === 'secretary_dashboard.php') ? '#' : 'secretary_dashboard.php';
        // Add more cases for other roles as needed
        default:
            return ($currentPage === 'dashboard.php') ? '#' : 'dashboard.php'; // Default to a general dashboard
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Mountain Top Specialty Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .sidebar-header {
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .doctor-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }

        .doctor-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand {
            margin: 0;
        }
    </style>
</head>

<body>

    <?php
    // Get the current page file name
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>

    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="doctor-photo">
                <img src="admin.png" alt="Doctor Photo">
            </div>
            <h3 class="brand">
                <span class="ti-unlink"></span>
                <span>Mountain Top Specialty Clinic</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>


        <div class="sidebar-menu">

            <ul>
                <li>
                    <a href="doctor_dashboard.php">
                        <span class="ti-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="doctor_schedules.php">
                        <span class="ti-agenda"></span>
                        <span>Schedules</span>
                    </a>
                </li>
                <li>
                    <a href="appointment.php">
                        <span class="ti-face-smile"></span>
                        <span>Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="doctor_record.php">
                        <span class="ti-clipboard"></span>
                        <span>Patient Record</span>
                    </a>
                </li>
            </ul>
            <ul class="nav-list">
                <!-- other sidebar links -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

</body>

</html>