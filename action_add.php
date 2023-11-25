<?php
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);

$insert = $db->insert("film", [
   "patient" => $_POST['patient'],
   "date_of_birth" => $_POST['date_of_birth'],
   "gender" => $_POST['gender'],
   "address" => $_POST['address'],
   "phone" => $_POST['phone'],
   "email" => $_POST['email'],
   "emergency_contact" => $_POST['emergency_contact'],
   "visit" => $_POST['visit'],
   "last_visit_reason" => $_POST['last_visit_reason'],
   "pressure" => $_POST['pressure'],
   "height" => $_POST['height'],
   "general_health" => $_POST['general_health'],
   "physician_notes" => $_POST['physician_notes'],
   "history" => $_POST['history'],
   "medications" => $_POST['medications'],
   "chronic_conditions" => $_POST['chronic_conditions'],
   "previous_surgeries" => $_POST['previous_surgeries'],
   "family_history" => $_POST['family_history'],
   "social_history" => $_POST['social_history'],
   "diagnosis" => $_POST['diagnosis'],
   "appointment" => $_POST['appointment'],
   "results" => $_POST['results'],
   "notes" => $_POST['notes']

]);

echo "data saved";
