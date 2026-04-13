<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: lavender;
        }

        form {
            background: lightgreen;
            padding: 25px;
            border-radius: 10px;
            width: 300px;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 6px;
            margin: 6px 0;
        }

        .button {
            text-align: center;
            margin-top: 10px;
        }

        .button input {
            width: auto;
            padding: 6px 20px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="login">
        <form action="authentication.php" method="post">

            <h3 style="text-align:center;">Student Login</h3>

            Username:
            <input type="text" name="username" placeholder="Enter Username" required>

            Password:
            <input type="password" name="password" placeholder="Enter Password" required>

            <div class="button">
                <!-- 🔥 FIXED: btnsubmit match authentication.php -->
                <input type="submit" name="btnsubmit" value="Login">
            </div>

            <div class="error">
                <?php
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </div>

            <div class="register-link">
                Don't have an account? <a href="registration.php">Register</a>
            </div>

        </form>
    </div>

</body>

</html>