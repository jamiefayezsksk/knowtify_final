<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>

</head>

<body>
    <div class="activity-grid">
        <div class="activity-card">
            <h3>Appointments</h3>

            <div class="table-responsive">
                <table border="1" width="500">
                    <tr align="center" bgcolor="#028960">
                        <td>Patient Name</td>
                        <td>Appointment Date</td>
                    </tr>
                    <?php
                    // Retrieve data only if $db is defined
                    if (isset($db)) {
                        $data = $db->retrieve("film");
                        $data = json_decode($data, 1);

                        if (is_array($data)) {
                            foreach ($data as $id => $film) {
                                echo "<tr>
                                            <td>{$film['patient']}</td>
                                            <td>{$film['appointment']}</td>
                                        </tr>";
                            }
                        }
                    }
                    ?>
                </table>
                <a href="add.php"><button>ADD DATA</button></a><br><br>
            </div>
        </div>
    </div>

</body>

</html>