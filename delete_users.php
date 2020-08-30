<?php
include 'includes/connect.php';
include 'includes/header.php';

if($_SESSION['admin_sid']==session_id())
{
    $user_id=$_GET['user_id'];
$delete="DELETE FROM users WHERE id=$user_id";
$run=mysqli_query($con,$delete) or die(mysqli_query($con));
        ?>
        <script>
    alert("Deleted Successfully");
    window.location.href='manage-users.php';
        </script>

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

include 'includes/script.php';
?>



