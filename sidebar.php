<?php
// Function to get the dashboard link based on user role
function getDashboardLink()
{
    // Replace the condition with your actual logic to determine the user's role
    $userRole = 'doctor'; // Example: Replace with actual user role

    switch ($userRole) {
        case 'admin':
            return 'admin_dashboard.php';
        case 'doctor':
            return 'doctor_dashboard.php';
        case 'secretary':
            return 'secretary_dashboard.php';
        // Add more cases for other roles as needed
        default:
            return 'dashboard.php'; // Default to a general dashboard
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="styles.css">
    </head>

<body>

    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="ti-unlink"></span>
                <span>Mountain Top Specialty Clinic</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?php echo getDashboardLink(); ?>">
                        <span class="ti-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="appointment.php">
                        <span class="ti-face-smile"></span>
                        <span>Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="schedule.php">
                        <span class="ti-agenda"></span>
                        <span>Schedules</span>
                    </a>
                </li>
                <li>
                    <a href="record.php">
                        <span class="ti-clipboard"></span>
                        <span>Patient Record</span>
                    </a>
                </li>
                <li>
                    <a href="account.php">
                        <span class="ti-settings"></span>
                        <span>Account</span>
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