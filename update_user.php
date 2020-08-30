<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
{
    if(isset($_POST['edit'])){
        $user_id=$_POST['user_id'];
        $role=htmlspecialchars($_POST['role']);
        $name=htmlspecialchars($_POST['name']);
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);

        $role=mysqli_real_escape_string($con,$_POST['role']);
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $username=mysqli_real_escape_string($con,$_POST['username']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);

        $sql="UPDATE users SET role='$role', name='$name', username='$username', password='$hashed_password' WHERE id=$user_id";
        $run=mysqli_query($con, $sql) or die(mysqli_error($con));
        if($run){
            ?>
            <script>
                alert("Updated Successfully");
                window.location.href='manage-users.php';
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Error Updating Item, Try Again");
                window.location.href='manage-users.php?user_id=<?php echo $user_id?>';
            </script>
            <?php
        }

    }

    ?>

    <?php
}
else
{
    if($_SESSION['customer_sid']==session_id())
    {
        header("location:index.php");
    }
    else{
        header("location:login.php");
    }
}
?>