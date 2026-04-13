<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .register {
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
            margin: 5px 0;
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

        .login-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="register">
        <form action="action.php" method="post">

            <h3 style="text-align:center;">Student Registration</h3>

            Full Name:
            <input type="text" name="fullname" placeholder="Enter Full Name" required>

            Username:
            <input type="text" name="username" placeholder="Enter Username" required>

            Phone Number:
            <input type="tel" name="phone" placeholder="Enter Phone Number" required>

            Email:
            <input type="email" name="email" placeholder="Enter Email" required>

            Gender:
            <br>
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female"> Female
            <input type="radio" name="gender" value="Other"> Other
            <br><br>

            Password:
            <input type="password" name="password" placeholder="Enter Password" required>

            Confirm Password:
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <div class="button">
                <input type="submit" name="register" value="Register">
            </div>

            <div class="login-link">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>
    </div>

</body>
</html>