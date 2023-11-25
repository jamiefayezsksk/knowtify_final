<?php
include("config.php");
include("firebaseRDB.php");

// Start the session
session_start();

// Registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $register_error = "Username and password are required";
    } else {
        $db = new firebaseRDB($databaseURL);
        $rdb = new firebaseRDB($databaseURL);

        $retrieve = $rdb->retrieve("/user", "username", "EQUAL", $username);
        $data = json_decode($retrieve, true);

        if (!isset($data['username'])) {
            // Username not registered, proceed with registration
            $insert = $db->insert("user", [
                "username" => $username,
                "password" => $password
            ]);

            if ($insert) {
                // Redirect to login page with a success message
                header("Location: login.php?registered=1");
                exit;
            } else {
                $register_error = "Failed to register account";
            }
        } else {
            $register_error = "Username already registered";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="register_styles.css">
</head>

<body>
    <form method="post" action="action_registerr.php">
        <h1>Register</h1>

        <?php if (isset($register_error)): ?>
            <div class="error">
                <?= $register_error; ?>
            </div>
        <?php endif; ?>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="register" value="REGISTER"><br>

        <p class="login-link">Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</body>

</html>