<?php
include("config.php");
include("firebaseRDB.php");

// Start the session
session_start();

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $login_error = "Username and password are required";
    } else {
        // Hardcoded usernames and common password for now
        $allowedUsernames = ["admin", "secretary", "doctor"];
        $commonPassword = "password";

        if (!in_array($username, $allowedUsernames)) {
            $login_error = "Invalid username";
        } else if ($password != $commonPassword) {
            $login_error = "Invalid password";
        } else {
            // Successful login
            $_SESSION["user"] = $username;

            // Redirect based on user role
            switch ($username) {
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                case 'secretary':
                    header("Location: secretary_dashboard.php");
                    break;
                case 'doctor':
                    header("Location: doctor_dashboard.php");
                    break;
                // Add more cases as needed
                default:
                    // Handle other roles or redirect to a default dashboard
                    header("Location: default_dashboard.php");
                    break;
            }

            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #d9534f;
            margin-bottom: 15px;
        }

        .register-link {
            text-align: center;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <h1>Login</h1>

        <?php if (isset($login_error)): ?>
            <div class="error">
                <?= $login_error; ?>
            </div>
        <?php endif; ?>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="LOGIN"><br>

        <p class="register-link">Don't have an account? <a href="register.php">Register here</a>.</p>
    </form>
</body>

</html>