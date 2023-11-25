<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
   <title>Patient Health Record</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
   <link rel="stylesheet" href="add_styles.css">
   <!-- Include jQuery and jQuery UI -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
      $(function () {
         // Datepicker for the "Next Appointment" field
         $("#appointment").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // Restrict to future dates
            onSelect: function (date) {
               // Update the schedule.php link with the selected date
               $("#schedule-link").attr("href", "schedule.php?date=" + date);
            }
         });
      });
   </script>
</head>

<body>
   <div class="form-container">
      <!-- Patient RECORD-->
      <h2>Patient Health Record</h2>
      <form method="post" action="action_add.php">
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
         <div class="form-group">
            <label class="form-label" for="address">Address:</label>
            <input class="form-input" type="text" name="address">
         </div>
         <div class="form-group">
            <label class="form-label" for="phone">Phone Number:</label>
            <input class="form-input" type="text" name="phone">
         </div>
         <div class="form-group">
            <label class="form-label" for="email">Email:</label>
            <input class="form-input" type="text" name="email">
         </div>
         <div class="form-group">
            <label class="form-label" for="emergency_contact">Emergency Contact:</label>
            <input class="form-input" type="text" name="emergency_contact">
         </div>

         <!-- Medical Visits Section -->
         <h3>Medical Visits</h3>
         <div class="form-group">
            <label class="form-label" for="visit">Last Visit:</label>
            <input class="form-input" type="text" name="visit">
         </div>
         <!-- Add more fields for medical visits as needed -->

         <!-- Medical History Section -->
         <h3>Medical History</h3>
         <div class="form-group">
            <label class="form-label" for="history">Allergies:</label>
            <input class="form-input" type="text" name="history">
         </div>
         <!-- Add more fields for medical history as needed -->

         <!-- Diagnosis Section -->
         <h3>Diagnosis</h3>
         <div class="form-group">
            <label class="form-label" for="diagnosis">Diagnosis:</label>
            <textarea class="form-textarea" name="diagnosis" rows="4" cols="50"></textarea>
         </div>

         <!-- Upcoming Appointments Section -->
         <h3>Upcoming Appointments</h3>
         <div class="form-group">
            <label class="form-label" for="appointment">Next Appointment:</label>
            <input class="form-input" type="text" name="appointment" id="appointment" readonly>
         </div>

         <!-- Link to Schedule Page -->
         <div class="form-group">
            <label class="form-label">View Schedule:</label>
            <a id="schedule-link" href="schedule.php" target="_blank">View Schedule</a>
         </div>

         <!-- Lab Results Section -->
         <h3>Lab Results</h3>
         <div class="form-group">
            <label class="form-label" for="results">Results:</label>
            <input class="form-input" type="text" name="results">
            <input type="Upload Image" value="Upload Image">
         </div>
         <!-- Add more fields for lab results as needed -->

         <!-- Doctor's Notes Section -->
         <h3>Doctor's Notes</h3>
         <div class="form-group">
            <label class="form-label" for="notes">Physician's Notes:</label>
            <textarea class="form-textarea" name="notes" rows="4" cols="50"></textarea>
         </div>

         <div class="form-submit">
            <input type="submit" value="SAVE">
         </div>
      </form>
   </div>
</body>

</html>