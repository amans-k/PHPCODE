<?php
session_start();
include("database.php");

// 🔐 login check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = base64_decode(base64_decode($_GET['id']));
    $enc_id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id='$id'";
    $res = mysqli_query($conn,$query);

    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
    } else {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<html>
<head>
    <title>Edit User</title>

    <style>
        body {
            background: lavender;
            font-family: Arial;
        }

        .container {
            width: 350px;
            margin: 80px auto;
            background: lightgreen;
            padding: 20px;
            border-radius: 10px;
        }

        input {
            width: 100%;
            padding: 6px;
            margin: 6px 0;
        }

        .btn {
            text-align: center;
            margin-top: 10px;
        }

        .btn input {
            padding: 6px 20px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .back {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h3 style="text-align:center;">Edit Profile</h3>

    <form action="authentication.php" method="post">

        <input type="hidden" name="uid" value="<?php echo $enc_id ?>" />

        Username:
        <input type="text" name="username" value="<?php echo $row['username'] ?>" required>

        Phone:
        <input type="text" name="phone" value="<?php echo $row['phone'] ?>" required>

        Email:
        <input type="email" name="email" value="<?php echo $row['email'] ?>" required>

        <div class="btn">
            <input type="submit" name="btnsubmit" value="Update User">
        </div>

    </form>

    <div class="back">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>

</div>

</body>
</html>