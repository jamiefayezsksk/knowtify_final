<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountain Top Specialty Clinic</title>
    <link rel="stylesheet" href="book_styles.css">
    <!-- Add Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Add custom styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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

            // Patient details column
            echo "<div style='flex: 1;'>";
            $patientName = isset($_POST['patient_name']) ? $_POST['patient_name'] : '';
            $contactNumber = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
            $patientAge = isset($_POST['patient_age']) ? $_POST['patient_age'] : 0;
            echo "<label>Patient's Full Name: <input type='text' name='patient_name' value='$patientName'></label><br>";
            echo "<label>Contact Number: <input type='text' name='contact_number' value='$contactNumber'></label><br>";
            echo "<label>Patient's Age: <input type='number' name='patient_age' min='0' max='150' value='$patientAge'></label>";
            echo "</div>";

            // Patient address and concern column
            echo "<div style='flex: 1;'>";
            $patientAddress = isset($_POST['patient_address']) ? $_POST['patient_address'] : '';
            $patientConcern = isset($_POST['patient_concern']) ? $_POST['patient_concern'] : '';
            echo "<label>Patient's Address: <textarea name='patient_address'>$patientAddress</textarea></label><br>";
            echo "<label>Reason for Appointment: <textarea name='patient_concern'>$patientConcern</textarea></label>";
            echo "</div>";

            // Doctor selection, date, and time column
            echo "<div style='flex: 1;'>";
            $doctorType = isset($_POST['doctor_type']) ? $_POST['doctor_type'] : 'General Practitioner';
            $appointmentDate = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
            $appointmentTime = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';
            echo "<label>Type of Doctor to Consult: 
                <select name='doctor_type' id='doctorTypeSelect' onchange='updateTimeSlots()'>
                    <option value='Internal Medicine' " . ($doctorType == 'Internal Medicine' ? 'selected' : '') . ">Internal Medicine</option>
                    <option value='Hematology' " . ($doctorType == 'Hematology' ? 'selected' : '') . ">Internal Medicine (Adult Hematology)</option>
                    <option value='Infectious' " . ($doctorType == 'Infectious' ? 'selected' : '') . ">Internal Medicine (Infectious Diseases)</option>
                    <option value='Pulmonology' " . ($doctorType == 'Infectious' ? 'selected' : '') . ">Internal Medicine (Pulmonology)</option>
                    <option value='Ob " . ($doctorType == 'Ob' ? 'selected' : '') . ">Obstetrics and Gynecology</option>
                    <option value='Orthopedics' " . ($doctorType == 'Orthopedics' ? 'selected' : '') . ">General Orthopaedic Surgery</option>
                    <option value='Physical' " . ($doctorType == 'Physical' ? 'selected' : '') . ">Physical Medicine and Rehabilitation</option>
                    <option value='Pediatrics' " . ($doctorType == 'Pediatrics' ? 'selected' : '') . ">Pediatrics, Vaccines, and Immunizations</option>
                </select>
      </label><br>";
            // Mock data for available days per doctor, replace this with your actual logic
            $availableDays = array(
                'Internal Medicine' => array('Monday', 'Wednesday', 'Thursday'),
                'Hematology' => array('Monday', 'Wednesday', 'Friday'),
                'Infectious' => array('Wednesday', 'Friday'),
                'Pulmonology' => array('Tuesday', 'Thursday'),
                'Ob' => array('Monday', 'Tuesday'),
                'Orthopedics' => array('Monday', 'Tuesday', 'Thursday'),
                'Physical' => array('Tuesday', 'Thursday'),
                'Pediatrics' => array('Monday', 'Wednesday', 'Thursday', 'Saturday'),
                // Add more doctors and their respective available days as needed
            );

            echo "<label>Appointment Date: 
    <input type='date' name='appointment_date' id='appointmentDate' value='$appointmentDate' required>
    <span id='unavailableDayError' style='color: red;'></span>
</label><br>";

            // JavaScript to enable/disable dates based on the selected doctor and show error for unavailable days
            echo "<script>
    function updateAvailableDays() {
        var availableDays = " . json_encode($availableDays) . ";
        var doctorTypeSelect = document.getElementById('doctorTypeSelect');
        var appointmentDateInput = document.getElementById('appointmentDate');
        var unavailableDayError = document.getElementById('unavailableDayError');
        var selectedDoctor = doctorTypeSelect.value;

        // Get the available days for the selected doctor
        var doctorAvailableDays = availableDays[selectedDoctor];

        // Enable all days by default
        for (var i = 1; i <= 31; i++) {
            var day = i < 10 ? '0' + i : '' + i;
            var dateOption = appointmentDateInput.querySelector('option[value=\"' + day + '\"]');
            dateOption.disabled = false;
            dateOption.classList.remove('highlight-day'); // Remove highlight class
        }

        // Highlight days that are available
        if (doctorAvailableDays) {
            for (var i = 1; i <= 31; i++) {
                var day = i < 10 ? '0' + i : '' + i;
                var dateOption = appointmentDateInput.querySelector('option[value=\"' + day + '\"]');
                var date = new Date(appointmentDateInput.value);
                date.setDate(i);
                var dayOfWeek = date.toLocaleDateString('en-US', { weekday: 'long' });

                if (doctorAvailableDays.includes(dayOfWeek)) {
                    dateOption.classList.add('highlight-day'); // Add highlight class
                } else {
                    dateOption.disabled = true;
                }
            }
        }
    }

                // Initial call to update available days
                updateAvailableDays();

                // Add event listener to doctor type select
                document.getElementById('doctorTypeSelect').addEventListener('change', function() {
                    updateAvailableDays();
                });

                // Add event listener to appointment date input
                document.getElementById('appointmentDate').addEventListener('change', function() {
                    updateAvailableDays();
                });
            </script>";

            // Mock data for time slots, you should replace this with your actual logic
            $timeSlots = array(
                'Internal Medicine' => array('03:00 PM', '3:30 AM', '04:00 PM', '04:30 PM'),
                'Hematology' => array('1:00 AM', '02:00 PM', '04:00 PM'),
                'Infectious' => array('09:00 AM', '10:00 AM', '02:00 PM', '04:00 PM'),
                'Pulmonology' => array('10:00 AM', '10:30 PM', '11:0 PM', '11:30 PM', '12:00 PM', '12:30 PM'),
                'Ob' => array('09:30 AM', '10:00 AM', '02:00 PM', '04:00 PM'),
                'Orthopedics' => array('02:00 PM', '04:00 PM'),
                'Physical' => array('10:00 AM', '02:00 PM', '04:00 PM'),
                'Pediatrics' => array('09:00 AM', '09:30 AM', '10:00 PM', '10:30 PM', '11:00 PM', '11:30 PM', '12:00 PM'),

                // Add more doctors and their respective time slots as needed
            );

            // Display a div for time slots
            echo "<div id='timeSlotContainer'>";
            echo "<label>Appointment Time: 
                <select name='appointment_time' id='appointmentTimeSelect'>";
            // Populate initial time slots based on the selected doctor
            foreach ($timeSlots[$doctorType] as $slot) {
                echo "<option value='$slot' " . ($appointmentTime == $slot ? 'selected' : '') . ">$slot</option>";
            }
            echo "</select>
            </label>";
            echo "</div>";

            echo "</div>";

            // JavaScript to generate and update time slots dynamically
            echo "<script>
            function generateTimeSlots() {
                var timeSlots = " . json_encode($timeSlots) . ";
                var doctorTypeSelect = document.getElementById('doctorTypeSelect');
                var appointmentTimeSelect = document.getElementById('appointmentTimeSelect');
                var selectedDoctor = doctorTypeSelect.value;

                // Remove existing options
                while (appointmentTimeSelect.options.length > 0) {
                    appointmentTimeSelect.remove(0);
                }

                // Add new time slots based on the selected doctor
                if (timeSlots[selectedDoctor]) {
                    timeSlots[selectedDoctor].forEach(function(slot) {
                        var option = document.createElement('option');
                        option.value = slot;
                        option.text = slot;
                        appointmentTimeSelect.add(option);
                    });
                }
            }

            // Initial call to populate time slots
            generateTimeSlots();

            // Add event listener to doctor type select
            document.getElementById('doctorTypeSelect').addEventListener('change', function() {
                generateTimeSlots();
            });
        </script>";


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