<?php
include 'includes/connect.php';
include 'includes/header.php';

if($_SESSION['admin_sid']==session_id())
{
    ?>

    <?php
    $role=htmlspecialchars($_POST['role']);
    $name=htmlspecialchars($_POST['name']);
    $username=htmlspecialchars($_POST['username']);

    $role=mysqli_real_escape_string($con,$_POST['role']);
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);

    $password=$_POST['password'];


    $select="SELECT * FROM users WHERE username='$username'";
    $query=mysqli_query($con, $select) or die(mysqli_error($con));
    $fetch=mysqli_fetch_assoc($query);
    if($fetch){
        ?>
        <script>
            alert("Existing User Already Exist");
            window.location.href="manage-users.php";
        </script>
        <?php
    }
    else{
        $insert="INSERT INTO users(role, name, username, password) VALUES ('$role', '$name','$username','$password')";
        $run=mysqli_query($con, $insert) or die(mysqli_error($con));
    }
    ?>
    <script>
        alert("Added User Succesfully");
        window.location.href="manage-users.php";
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

