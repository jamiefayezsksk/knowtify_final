<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Top Specialty Clinic</title>
    <link rel="stylesheet" href="styles_book.css">
</head>

<body>
    <header>
        <div class="header-content">
            <section class="image-section">
                <img src="clinic.png" alt="Clinic Logo">
            </section>
            <div class="clinic-details">
                <h1>Mountain Top Specialty Clinic</h1>
                <p>Your Trusted Healthcare Partner</p>
                <p class="contact-info">
                    <strong>Contact:</strong> 0977 062 5890<br>
                    <strong>Address:</strong> 101 General Luna Road, Global Multispecialty Diagnostic Center, 2nd Floor,
                    Unit 4, Baguio City, Philippines
                </p>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#about">About Us</a></li>
            <li><a href="#appointment">Book an Appointment</a></li>
            <li><a href="#services">Our Specialties</a></li>
        </ul>
    </nav>

    <section id="about" class="section">
        <div class="container">
            <h2>About Us</h2>
            <p>Welcome to Mountain Top Specialty Clinic, where your health is our priority. Our dedicated team of
                healthcare professionals is committed to providing high-quality, compassionate care to our community.
            </p>
            <p>At our clinic, we offer a range of specialized medical services to address your unique healthcare needs.
                Whether you require routine check-ups, specialized treatments, or expert consultations, we are here for
                you.</p>
        </div>
    </section>

    <section id="appointment" class="section">
        <div class="container">
            <h2>Book an Appointment</h2>
            <p>Ready to prioritize your health? Schedule an appointment with our experienced healthcare professionals.
            </p>
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
            <button onclick=\"showSuccessMessage()\">Confirm Booking</button>
            <button onclick=\"redirectToLandingPage()\">Exit</button>
        </div>
        <script>
            function showSuccessMessage() {
                alert('Booking successful! Check your SMS for details.');
                redirectToLandingPage();
            }

            function redirectToLandingPage() {
                window.location.href = 'book.php'; // 
            }
        
        </script>";
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
        </div>
    </section>

    <section id="services" class="section">
        <div class="container">
            <h2>Our Specialties</h2>
            <div class="services-cards">
                <div class="service-card">
                    <img src="internal.jpg" alt="General Medicine">
                    <h3>Internal Medicine</h3>
                    <p>Comprehensive healthcare for all ages.</p>
                </div>
                <div class="service-card">
                    <img src="pulmonology.jpg" alt="Pulmonology">
                    <h3>Pulmonology</h3>
                    <p>Specialized care for heart health.</p>
                </div>
                <div class="service-card">
                    <img src="generl.jpg" alt="Orthopedics">
                    <h3>Orthopedics</h3>
                    <p>Expertise in musculoskeletal conditions.</p>
                </div>
                <div class="service-card">
                    <img src="physical.jpg" alt="Dermatology">
                    <h3>Physical</h3>
                    <p>Diagnosis and treatment of skin conditions.</p>
                </div>
                <div class="service-card">
                    <img src="ob.jpg" alt="Obstetrics and Gynecology">
                    <h3>Obstetrics and Gynecology</h3>
                    <p>Women's health and reproductive care.</p>
                </div>
                <div class="service-card">
                    <img src="pedia.jpg" alt="Pediatrics">
                    <h3>Pediatrics</h3>
                    <p>Specialized care for children's health.</p>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <p>&copy; 2023 Mountain Top Specialty Clinic. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function redirectAppointment() {
            window.location.href = "appointment.php";
        }
    </script>
</body>

</html>