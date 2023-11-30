<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
   <link rel="stylesheet" href="edit_styles.css">
   <title>Edit</title>
</head>

<body>
   <?php
   include("config.php");
   include("firebaseRDB.php");

   $db = new firebaseRDB($databaseURL);
   $id = $_GET['id'];
   $retrieve = $db->retrieve("film/$id");
   $data = json_decode($retrieve, 1);

   ?>
   <form method="post" action="action_edit.php">
      <table border="0" width="500">
         <tr>
            <td colspan="3"><strong>Patient Health Record</strong></td>
         </tr>
         <tr>
            <td colspan="3"><strong>Patient Information:</strong></td>
         </tr>
         <tr>
            <td>Patient Name:</td>
            <td>:</td>
            <td><input type="text" name="patient" value="<?php echo $data['patient']; ?>"></td>
         </tr>
         <tr>
            <td>Date of Birth:</td>
            <td>:</td>
            <td><input type="text" name="date_of_birth" value="<?php echo $data['date_of_birth']; ?>"></td>
         </tr>
         <tr>
            <td>Gender:</td>
            <td>:</td>
            <td><input type="text" name="gender" value="<?php echo $data['gender']; ?>"></td>
         </tr>
         <tr>
            <td>Address:</td>
            <td>:</td>
            <td><input type="text" name="address" value="<?php echo $data['address']; ?>"></td>
         </tr>
         <tr>
            <td>Phone Number:</td>
            <td>:</td>
            <td><input type="text" name="phone" value="<?php echo $data['phone']; ?>"></td>
         </tr>
         <tr>
            <td>Email:</td>
            <td>:</td>
            <td><input type="text" name="email" value="<?php echo $data['email']; ?>"></td>
         </tr>
         <tr>
            <td>Emergency Contact:</td>
            <td>:</td>
            <td><input type="text" name="emergency_contact" value="<?php echo $data['emergency_contact']; ?>"></td>
         </tr>
         <!-- Medical Visits Section -->
         <<tr>
            <td colspan="3"><strong>Medical Visits:</strong></td>
            </tr>
            <tr>
               <td>Last Visit:</td>
               <td>:</td>
               <td><input type="text" name="visit" value="<?php echo $data['visit']; ?>"></td>
            </tr>
            <tr>
               <td>Reason for Visit:</td>
               <td>:</td>
               <td><input type="text" name="last_visit_reason" value="<?php echo $data['last_visit_reason']; ?>"></td>
            </tr>
            <tr>
               <td>Blood Pressure:</td>
               <td>:</td>
               <td><input type="text" name="pressure" value="<?php echo $data['pressure']; ?>"></td>
            </tr>
            <tr>
               <td>Height:</td>
               <td>:</td>
               <td><input type="text" name="height" value="<?php echo $data['height']; ?>"></td>
            </tr>
            <tr>
               <td>General Health:</td>
               <td>:</td>
               <td><input type="text" name="general_health" value="<?php echo $data['general_health']; ?>"></td>
            </tr>
            <tr>
               <td>Physician's Notes:</td>
               <td>:</td>
               <td><input type="text" name="physician_notes" value="<?php echo $data['physician_notes']; ?>"></td>
            </tr>
            <!-- Medical History Section -->
            <tr>
               <td colspan="3"><strong>Medical History:</strong></td>
            </tr>
            <tr>
               <td>Allergies:</td>
               <td>:</td>
               <td><input type="text" name="history" value="<?php echo $data['history']; ?>"></td>
            </tr>
            <tr>
               <td>Medications:</td>
               <td>:</td>
               <td><input type="text" name="medications" value="<?php echo $data['medications']; ?>"></td>
            </tr>
            <tr>
               <td>Chronic Conditions:</td>
               <td>:</td>
               <td><input type="text" name="chronic_conditions" value="<?php echo $data['chronic_conditions']; ?>"></td>
            </tr>
            <tr>
               <td>Previous Surgeries:</td>
               <td>:</td>
               <td><input type="text" name="previous_surgeries" value="<?php echo $data['previous_surgeries']; ?>"></td>
            </tr>
            <tr>
               <td>Family History:</td>
               <td>:</td>
               <td><input type="text" name="family_history" value="<?php echo $data['family_history']; ?>"></td>
            </tr>
            <tr>
               <td>Social History:</td>
               <td>:</td>
               <td><input type="text" name="social_history" value="<?php echo $data['social_history']; ?>"></td>
            </tr>
            <!-- Diagnosis Section -->
            <tr>
               <td colspan="3"><strong>Diagnosis:</strong></td>
            </tr>
            <tr>
               <td>Diagnosis:</td>
               <td>:</td>
               <td><textarea name="diagnosis" rows="4" cols="50"><?php echo $data['diagnosis']; ?></textarea></td>
            </tr>


            <!-- Upcoming Appointments Section -->
            <tr>
               <td colspan="3"><strong>Upcoming Appointments:</strong></td>
            </tr>
            <tr>
               <td>Next Appointment:</td>
               <td>:</td>
               <td><input type="text" name="appointment" value="<?php echo $data['appointment']; ?>"></td>
            </tr>

            <!-- Lab Results Section -->
            <tr>
               <td colspan="3"><strong>Lab Results:</strong></td>
            </tr>
            <tr>
               <td>Total Cholesterol:</td>
               <td>:</td>
               <td><input type="text" name="total_cholesterol" value="<?php echo $data['total_cholesterol']; ?>"></td>
            </tr>
            <tr>
               <td>HDL Cholesterol:</td>
               <td>:</td>
               <td><input type="text" name="hdl_cholesterol" value="<?php echo $data['hdl_cholesterol']; ?>"></td>
            </tr>
            <tr>
               <td>LDL Cholesterol:</td>
               <td>:</td>
               <td><input type="text" name="ldl_cholesterol" value="<?php echo $data['ldl_cholesterol']; ?>"></td>
            </tr>
            <tr>
               <td>Triglycerides:</td>
               <td>:</td>
               <td><input type="text" name="triglycerides" value="<?php echo $data['triglycerides']; ?>"></td>
            </tr>

            <!-- Doctor's Notes Section -->
            <tr>
               <td colspan="3"><strong>Doctor's Notes:</strong></td>
            </tr>
            <tr>
               <td>Physician's Notes:</td>
               <td>:</td>
               <td><textarea name="notes" rows="4" cols="50"><?php echo $data['notes']; ?></textarea>
               </td>
            </tr>
            <tr>
               <td>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="submit" value="SAVE">
               </td>
            </tr>

      </table>
   </form>
</body>

</html>