<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if (isset($_POST['export'])) {
    $filename = "patient_data.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Patient Information', 'Visit', 'History', 'Diagnosis', 'Upcoming Appointments', 'Doctor\'s Notes'));

    $data = $db->retrieve("film");
    $data = json_decode($data, 1);

    if (is_array($data)) {
        foreach ($data as $id => $film) {
            fputcsv($output, array($film['patient'], $film['visit'], $film['history'], $film['diagnosis'], $film['appointment'], $film['notes']));
        }
    }

    fclose($output);
    exit();
}
?>