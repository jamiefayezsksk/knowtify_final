<?php
include("config.php");
include("firebaseRDB.php");
include('secretary_sidebar.php');

$db = new firebaseRDB($databaseURL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records - kNOWtify</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 100px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
        }

        .content-container {
            width: 60%;
            text-align: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #028960;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons-container form {
            display: inline-block;
        }

        .search-form {
            margin: 20px;
        }
    </style>
</head>

<body>

    <div class="content-container">
        <h1>Patient Records</h1>
        <form action="" method="post" class="search-form">
            <label for="search">Search by Patient Name:</label>
            <input type="text" name="search" id="search" placeholder="Enter patient name...">
            <input type="submit" value="Search">
        </form>
        <div class="buttons-container">
            <form action="add.php" method="get">
                <button type="submit">Add New Patient</button>
            </form>

            <form action="download.php" method="post">
                <input type="submit" name="export" value="Export to CSV">
            </form>
        </div>

        <table>
            <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Visit</th>
                <th>History</th>
                <th>Diagnosis</th>
                <th>Upcoming Appointments</th>
                <th>Doctor's Notes</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
            if (isset($_POST['search'])) {
                $search = $_POST['search'];

                $data = $db->retrieve("film");
                $data = json_decode($data, true);

                if (is_array($data)) {
                    foreach ($data as $id => $patient) {
                        if (stripos($patient['patient'], $search) !== false) {
                            echo "<tr>
                           <td>{$id}</td>
                           <td><a href='name.php?id={$id}'>{$patient['patient']}</a></td>
                           <td>{$patient['visit']}</td>
                           <td>{$patient['history']}</td>
                           <td>{$patient['diagnosis']}</td>
                           <td>{$patient['appointment']}</td>
                           <td>{$patient['notes']}</td>
                           <td><a href='edit.php?id={$id}'>EDIT</a></td>
                           <td><a href='delete.php?id={$id}'>DELETE</a></td>
                        </tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
                }
            } else {
                $data = $db->retrieve("film");
                $data = json_decode($data, true);

                if (is_array($data)) {
                    foreach ($data as $id => $patient) {
                        echo "<tr>
                           <td>{$id}</td>
                           <td><a href='name.php?id={$id}'>{$patient['patient']}</a></td>
                           <td>{$patient['visit']}</td>
                           <td>{$patient['history']}</td>
                           <td>{$patient['diagnosis']}</td>
                           <td>{$patient['appointment']}</td>
                           <td>{$patient['notes']}</td>
                           <td><a href='edit.php?id={$id}'>EDIT</a></td>
                           <td><a href='delete.php?id={$id}'>DELETE</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
                }
            }
            ?>
        </table>
    </div>

</body>

</html>