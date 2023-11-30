<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Top Specialty Clinic</title>
    <link rel="stylesheet" href="book_styles.css">
    <!-- Add Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <header>
        <div class="header-content">
            <section class="image-section">
                <img src="clinic.png" alt="Clinic Logo">
            </section>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Specialties</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#appointments">Book an Appointment</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <section id="appointment" class="section">
        <div class="container">
            <h1>Elevate Your Health Journey:
                Seamless Booking,Exceptional Care
                <br>at Mountain Top Specialty Clinic.
            </h1>
            <div class="flex-container">
                <div class="button-container">
                    <button onclick="location.href='#appointments'" class="book-appointment-btn">Book an
                        Appointment</button>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="section">
        <div class="container">
            <h2>About Us</h2>
            <p>Your go-to clinic in Baguio City, with specialists in IM, Pedia, Pulmo, IDS, Hema, Ortho, OB, & Rehab.
            </p>
            <p>Welcome to Mountain Top Specialty Clinic, where your health is our priority. Our dedicated team of
                healthcare professionals is committed to providing high-quality, compassionate care to our community.
            </p>
            <p>At our clinic, we offer a range of specialized medical services to address your unique healthcare needs.
                Whether you require routine check-ups, specialized treatments, or expert consultations, we are here for
                you.</p>
        </div>
    </section>
    <section id="appointments" class="section">
        <div class="container">
            <h2>Book an Appointment</h2>
            <p>Ready to prioritize your health? Schedule an appointment with our experienced healthcare professionals.
            </p>
            <br>
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
            $buttonStyle = "background-color: #63962D; color: #ffffff; font-weight: bold;";

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
            <div class='booking-summary-overlay'></div>
            <div class='booking-summary-container'>
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
            $patientAge = isset($_POST['patient_age']) ? $_POST['patient_age'] : 0;
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
            echo "<label>Type of Doctor to Consult: 
                <select name='doctor_type'>
                    <option value='Internal Medicine' " . ($doctorType == 'Internal Medicine' ? 'selected' : '') . ">Internal Medicine</option>
                    <option value='Pulmonology' " . ($doctorType == 'Pulmonology' ? 'selected' : '') . ">Pulmonology</option>
                    <option value='Orthopedics' " . ($doctorType == 'Orthopedics' ? 'selected' : '') . ">Orthopedics</option>
                    <option value='Physical' " . ($doctorType == 'Physical' ? 'selected' : '') . ">Physical</option>
                    <option value='Obstetrics and Gynecology' " . ($doctorType == 'Obstetrics and Gynecology' ? 'selected' : '') . ">Obstetrics and Gynecology</option>
                    <option value='Pediatrics' " . ($doctorType == 'Pediatrics' ? 'selected' : '') . ">Pediatrics</option>
                    <option value='Internal Medicine Infectious Diseases' " . ($doctorType == 'Internal Medicine Infectious Diseases' ? 'selected' : '') . ">Internal Medicine Infectious Diseases</option>
                </select>
      </label><br>";
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

    <section id="contact" class="section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>
                <i class="fas fa-phone-alt"></i> 0977 062 5890
                &nbsp;&nbsp;&nbsp;
                <i class="fab fa-facebook-square"></i>
                <a href="https://www.facebook.com/MountainTopClinic" target="_blank">Mountain Top Specialty Clinic</a>
            </p>
            <br>
            <h2>Visit Us at</h2>
            <p>101 General Luna Road, Global Multispecialty Diagnostic Center, 2nd Floor, Unit 4, Baguio City,
                Philippines</p>
        </div>
    </section>


    <section id="services" class="section">
        <div class="container">
            <h2>Our Specialties</h2>
            <div class="services-cards">
                <div class="service-card">
                    <img src="internalmed.jpg" alt="Internal Medicine">
                    <h3>Internal Medicine</h3>
                    <p>Specialized care for Adult Diseases.</p>
                </div>
                <div class="service-card">
                    <img src="internal.jpg" alt="General Medicine">
                    <h3>Internal Medicine</h3>
                    <h4>(Adult Hematology)</h4>
                    <p>Comprehensive healthcare for all ages.</p>
                </div>
                <div class="service-card">
                    <img src="infectious.jpg" alt="Internal Medicine and Infectious Diseases">
                    <h3>Internal Medicine</h3>
                    <h4>(Infectious Diseases)</h4>
                    <p>Specialized care for Infectious Diseases.</p>
                </div>
                <div class="service-card">
                    <img src="pulmonology.jpg" alt="Pulmonology">
                    <h3>Internal Medicine</h3>
                    <h4>(Pulmonology)</h4>
                    <p>Specialized care for heart health.</p>
                </div>
                <div class="service-card">
                    <img src="ob.jpg" alt="Obstetrics and Gynecology">
                    <h3>Obstetrics and Gynecology</h3>
                    <p>Women's health and reproductive care.</p>
                </div>
                <div class="service-card">
                    <img src="generl.jpg" alt="Orthopedics">
                    <h3>General Orthopaedic Surgery</h3>
                    <p>Expertise in musculoskeletal conditions.</p>
                </div>
                <div class="service-card">
                    <img src="physical.jpg" alt="Dermatology">
                    <h3>Physical Medicine and Rehabilitation</h3>
                    <p>Diagnosis and treatment of skin conditions.</p>
                </div>

                <div class="service-card">
                    <img src="pedia.jpg" alt="Pediatrics">
                    <h3>Pediatrics, Vaccines, and Immunizations</h3>
                    <p>Specialized care for children's health.</p>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <p>&copy; 2023 Mountain Top Specialty Clinic. All rights reserved.</p>
            <a href="https://www.facebook.com/YourClinic" target="_blank" class="icon-link">
                <i class="fab fa-facebook-square"></i>
            </a>
            <a href="tel:+1234567890" class="icon-link">
                <i class="fas fa-phone-alt"></i>
            </a>
        </div>
    </footer>

    <script>
        function redirectAppointment() {
            window.location.href = "appointment.php";
        }
    </script>
</body>

</html>