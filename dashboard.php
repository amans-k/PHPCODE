<?php
include("database.php");

$query = "select * from users";
$res = mysqli_query($conn,$query);
$cnt = mysqli_num_rows($res);
?>
<html>
    <head><title>Dashboard Page</title></head>
    <body>
        <h3>Users List</h3>
        <table border="1">
            <tr>
                <th>#</th><th>Username</th><th>Contact</th><th>Email</th><th>Password</th><th>Actions</th>
            </tr>
            <?php
                if($cnt > 0){
                    $i=1;
                    while($row = mysqli_fetch_assoc($res)){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><a href="user_edit.php?id=<?php echo base64_encode(base64_encode($row['id'])) ?>">Edit</a> 
                          <a href="javascript:void(0)" onclick="deletUser"> Delete</a>  
                        </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo "<tr><th colspan='6'>No Data Found</th></tr>";
                }
            ?>
        </table>
        <script type="text/javascript">
         function confirmDelete(){
             if(confirm("Are you sure you want to delete this user?")){
                 return true;
             }
             else{
                 return false;
             }
         }
        </script>
    </body>
</html>