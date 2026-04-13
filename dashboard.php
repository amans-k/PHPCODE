<?php
session_start();
include("database.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM users";
$res = mysqli_query($conn,$query);
$total = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            background: #34495e;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #1abc9c;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            margin-bottom: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background: #1abc9c;
            color: white;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit { background: orange; }
        .delete { background: red; }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>MyApp</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="file.php">My Profile</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

    <div class="topbar">
        <h2>Dashboard</h2>
        <div>Welcome, <b><?php echo $_SESSION['username']; ?></b></div>
    </div>

    <!-- Cards -->
    <div class="cards">
        <div class="card">
            <h3><?php echo $total; ?></h3>
            <p>Total Users</p>
        </div>
    </div>

    <!-- Table -->
    <h3>Users List</h3>

    <table>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        $i=1;
        while($row = mysqli_fetch_assoc($res)){
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>

            <td>
                <a class="btn edit" href="user_edit.php?id=<?php echo base64_encode(base64_encode($row['id'])) ?>">Edit</a>
                <a class="btn delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>