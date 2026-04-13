<?php
session_start();
require_once('database.php');

// 🔐 check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

// 🔥 fetch LIVE user data from DB
$query = "SELECT * FROM users WHERE id='$id'";
$res = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial;
            background: lavender;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0px 0px 10px gray;
        }

        h2 {
            text-align: center;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .btn a {
            text-decoration: none;
            background: green;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="card">
    <h2>My Profile</h2>

    <p><b>Full Name:</b> <?php echo $user['fullname']; ?></p>
    <p><b>Username:</b> <?php echo $user['username']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
    <p><b>Gender:</b> <?php echo $user['gender']; ?></p>

    <div class="btn">
        <a href="dashboard.php">Back</a>
        <a href="logout.php" style="background:red;">Logout</a>
    </div>
</div>

</body>
</html>