<?php
session_start();
require_once('database.php');

if(isset($_POST['btnsubmit'])){

    /* ================= LOGIN ================= */
    if($_POST['btnsubmit'] == "Login"){

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if(empty($username) || empty($password)){
            $_SESSION['error'] = "All fields are required";
            header("Location: login.php");
            exit();
        }

        // fetch user
        $query = "SELECT * FROM users WHERE username='$username'";
        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res) == 1){

            $user = mysqli_fetch_assoc($res);

            // 🔐 password verify
            if(password_verify($password, $user['password'])){
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: dashboard.php");
                exit();

            } else {
                $_SESSION['error'] = "Invalid Password!";
                header("Location: login.php");
                exit();
            }

        } else {
            $_SESSION['error'] = "User not found!";
            header("Location: login.php");
            exit();
        }
    }

    /* ================= REGISTER ================= */
    else if($_POST['btnsubmit'] == "Register"){

        $fullname = trim($_POST['fullname'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        if(empty($fullname) || empty($username) || empty($phone) || empty($email) || empty($gender) || empty($password) || empty($confirm_password)){
            echo "All fields are required";
            exit();
        }

        if($password !== $confirm_password){
            echo "Passwords do not match";
            exit();
        }

        if(strlen($password) < 8){
            echo "Password must be at least 8 characters";
            exit();
        }

        // check existing user
        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($check) > 0){
            echo "User already exists!";
            exit();
        }

        // 🔐 secure password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fullname, username, phone, email, gender, password) 
                  VALUES ('$fullname','$username','$phone','$email','$gender','$hashed_password')";

        if(mysqli_query($conn, $query)){
            header("Location: login.php");
            exit();
        } else {
            echo "Registration Failed!";
        }
    }

    /* ================= UPDATE USER ================= */
    else if($_POST['btnsubmit'] == "Update User"){

        $uid = base64_decode(base64_decode($_POST['uid']));
        $username = trim($_POST['username']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);

        if(empty($uid) || empty($username)){
            header("Location: dashboard.php");
            exit();
        }

        $check = mysqli_query($conn, "SELECT id FROM users WHERE id='$uid'");

        if(mysqli_num_rows($check) == 1){

            $update = "UPDATE users 
                       SET username='$username', phone='$phone', email='$email' 
                       WHERE id='$uid'";

            if(mysqli_query($conn, $update)){
                echo "<script>
                        alert('User Updated Successfully!');
                        window.location='dashboard.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Update Failed!');
                        window.location='user_edit.php?id=$uid';
                      </script>";
            }

        } else {
            header("Location: dashboard.php");
            exit();
        }
    }
}
?>