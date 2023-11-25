<?php
include("config.php");
include("firebaseRDB.php");

// Start the session
session_start();

function redirect($location, $params = [])
{
    $query = http_build_query($params);
    header("Location: $location?$query");
    exit;
}

// Registration logic
$insert = $db->insert("user", [
   "username" => $_POST['username'],
   "password" => $_POST['password']
]);

if ($username == "" || $password == "") {
        $register_error = "Username and password are required";
    } else {
        $db = new firebaseRDB($databaseURL);
        $rdb = new firebaseRDB($databaseURL);

        $retrieve = $rdb->retrieve("/user", "username", "EQUAL", $username);
        $data = json_decode($retrieve, true);

        if (!isset($data['username'])) {
            // Username not registered, proceed with registration
            $insert = $db->insert("username", [
                "username" => $username,
                "password" => $password
            ]);

            if ($insert) {
                // Redirect to login page with a success message
                redirect("index.php", ["registered" => 1]);
            } else {
                $register_error = "Failed to register account";
            }
        } else {
            $register_error = "Username already registered";
        }
    }
?>