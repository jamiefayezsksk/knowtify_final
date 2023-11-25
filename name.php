<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_GET['id'];
$retrieve = $db->retrieve("film/$id");
$data = json_decode($retrieve, 1);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Patient Health Record</title>
    <style>
        .print-button {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Patient Health Record</h1>

    <div>
        <!-- Patient Information Section -->
        <strong>Patient Information:</strong>
        <p>Patient Name:
            <?php echo $data['patient']; ?>
        </p>
        <p>Date of Birth:
            <?php echo $data['date_of_birth']; ?>
        </p>
        <p>Gender:
            <?php echo $data['gender']; ?>
        </p>

        <!-- Contact Information Section -->
        <strong>Contact Information:</strong>
        <p>Email:
            <?php echo $data['email']; ?>
        </p>
        <p>Phone:
            <?php echo $data['phone']; ?>
        </p>
        <p>Address:
            <?php echo $data['address']; ?>
        </p>
        <p>Emergency Contact:
            <?php echo $data['emergency_contact']; ?>
        </p>
        <!-- Medical Visits Section -->
        <strong>Medical Visits:</strong>
        <p>Last Visit:
            <?php echo $data['visit']; ?>
        </p>
        <p>Reason for Visit:
            <?php echo $data['last_visit_reason']; ?>
        </p>
        <p>Blood Pressure:
            <?php echo $data['pressure']; ?>
        </p>
        <p>Height:
            <?php echo $data['height']; ?>
        </p>
        <p>General Health:
            <?php echo $data['general_health']; ?>
        </p>
        <p>Physician's Notes:
            <?php echo $data['physician_notes']; ?>
        </p>

        <!-- Medical History Section -->
        <strong>Medical History:</strong>
        <p>Allergies:
            <?php echo $data['history']; ?>
        </p>
        <p>Medications:
            <?php echo $data['medications']; ?>
        </p>
        <p>Chronic Conditions:
            <?php echo $data['chronic_conditions']; ?>
        </p>
        <p>Previous Surgeries:
            <?php echo $data['previous_surgeries']; ?>
        </p>
        <p>Family History:
            <?php echo $data['family_history']; ?>
        </p>
        <p>Social History:
            <?php echo $data['social_history']; ?>
        </p>

        <!-- Diagnosis Section -->
        <strong>Diagnosis:</strong>
        <p>Diagnosis:
            <?php echo $data['diagnosis']; ?>
        </p>
    </div>

    <!-- Print Button -->
    <button class="print-button" onclick="window.print()">Print</button>
</body>

</html>