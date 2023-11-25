<?php
// Include the backend file (replace 'backend.php' with the actual filename)
include_once 'backend.php';

// Set page title and favicon
echo "<script>
document.title = 'Mountain Top Specialty Clinic';
</script>";

// Styling
$clinicNameStyle = "font-size: 36px; color: #2b9348; font-weight: bold;";
$headerStyle = "font-size: 24px; color: #007f5f; font-weight: bold;";
$buttonStyle = "background-color: #2b9348; color: #ffffff; font-weight: bold;";

// Header with Clinic Logo
echo "<img src='clinic.png' width='200'>";
echo "<h1>Mountain Top Specialty Clinic</h1>";
echo "<p style='$clinicNameStyle'>Book an Appointment</p>";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_button'])) {
    $patientName = $_POST['patient_name'];
    $contactNumber = $_POST['contact_number'];
    $patientAge = $_POST['patient_age'];
    $patientAddress = $_POST['patient_address'];
    $patientConcern = $_POST['patient_concern'];
    $doctorType = $_POST['doctor_type'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];


    // Display a summary of booking details
    echo "
    <div style='position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; backdrop-filter: blur(5px); z-index: 999;'></div>
    <div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f4f4f4; padding: 20px; box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.1); z-index: 1000;'>
        <h2>Booking Details Summary</h2>
        <p><strong>Patient's Full Name:</strong> $patientName</p>
        <p><strong>Contact Number:</strong> $contactNumber</p>
        <p><strong>Patient's Age:</strong> $patientAge</p>
        <p><strong>Patient's Address:</strong> $patientAddress</p>
        <p><strong>Reason for Appointment:</strong> $patientConcern</p>
        <p><strong>Type of Doctor to Consult:</strong> $doctorType</p>
        <p><strong>Appointment Date:</strong> $appointmentDate</p>
        <p><strong>Appointment Time:</strong> $appointmentTime</p>
        <button onclick=\"if(confirm('Are you sure you want to book this appointment?')) { element.value=1; this.form.submit(); setTimeout(() => alert('Booking successful!'), 500); }\">Confirm Booking</button>
        <button onclick=\"document.querySelector('div').style.display='none'; document.querySelector('div').style.display='none';\">Exit</button>
    </div>";
}

// 3-column layout for the appointment form
echo "<form method='post'>";
echo "<div style='display: flex;'>";
echo "<div style='flex: 1;'>";
$patientName = isset($_POST['patient_name']) ? $_POST['patient_name'] : '';
$contactNumber = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
$patientAge = isset($_POST['patient_age']) ? $_POST['patient_age'] : 25;
echo "<label>Patient's Full Name: <input type='text' name='patient_name' value='$patientName'></label><br>";
echo "<label>Contact Number: <input type='text' name='contact_number' value='$contactNumber'></label><br>";
echo "<label>Patient's Age: <input type='number' name='patient_age' min='0' max='150' value='$patientAge'></label>";
echo "</div>";

echo "<div style='flex: 1;'>";
$patientAddress = isset($_POST['patient_address']) ? $_POST['patient_address'] : '';
$patientConcern = isset($_POST['patient_concern']) ? $_POST['patient_concern'] : '';
echo "<label>Patient's Address: <textarea name='patient_address'>$patientAddress</textarea></label><br>";
echo "<label>Reason for Appointment: <textarea name='patient_concern'>$patientConcern</textarea></label>";
echo "</div>";

echo "<div style='flex: 1;'>";
$doctorType = isset($_POST['doctor_type']) ? $_POST['doctor_type'] : 'General Practitioner';
$appointmentDate = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
$appointmentTime = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
echo "<label>Type of Doctor to Consult: <select name='doctor_type'><option value='General Practitioner' " . ($doctorType == 'General Practitioner' ? 'selected' : '') . ">General Practitioner</option><option value='Specialist' " . ($doctorType == 'Specialist' ? 'selected' : '') . ">Specialist</option></select></label><br>";
echo "<label>Appointment Date: <input type='date' name='appointment_date' value='$appointmentDate'></label><br>";
echo "<label>Appointment Time: <input type='time' name='appointment_time' value='$appointmentTime'></label>";
echo "</div>";

echo "</div>";

// Book Appointment button
echo "<input type='submit' name='book_button' value='Book Appointment' style='$buttonStyle' onclick=\"if(confirm('Are you sure you want to book this appointment?')) { element.value=1; this.form.submit(); }\">";

echo "</form>";
?>