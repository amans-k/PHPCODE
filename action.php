<?php
session_start();
require_once('database.php');

/* ================= REGISTER ================= */
if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'] ?? '';
    $username = $_POST['username'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // validation
    if (
        empty($fullname) || empty($username) || empty($phone) ||
        empty($email) || empty($gender) || empty($password)
    ) {
        die("All fields are required");
    }

    if ($password != $confirm) {
        die("Password not matched");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters");
    }

    // secure password hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // safe insert
    $query = "INSERT INTO users (fullname, username, phone, email, gender, password) 
              VALUES ('$fullname','$username','$phone','$email','$gender','$hashed_password')";

    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration Failed: " . mysqli_error($conn);
    }
}


/* ================= UPDATE USER ================= */
if (isset($_POST['btnsubmit']) && $_POST['btnsubmit'] == "Update User") {

    $uid = base64_decode(base64_decode($_POST['uid']));
    $username = $_POST['username'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($uid) || empty($username)) {
        die("Invalid request");
    }

    $query = "UPDATE users 
              SET username='$username', phone='$phone', email='$email' 
              WHERE id='$uid'";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Update Failed: " . mysqli_error($conn);
    }
}
?>