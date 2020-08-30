<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
{
    $user_id=$_POST['user_id'];
    $oldpassword=mysqli_real_escape_string($con,$_POST['oldpassword']);
    $newpassword=mysqli_real_escape_string($con,$_POST['newpassword']);
    $retype_password=mysqli_real_escape_string($con,$_POST['retype_password']);
    
    $check=mysqli_query($con,"SELECT * FROM users WHERE id='$user_id'") or die(mysqli_error($con));
    $fetch=mysqli_fetch_assoc($check);
    $actual_password=$fetch['password'];
    if($oldpassword===$actual_password){
        if($newpassword===$retype_password){
            $hashed_password=password_hash($retype_password, PASSWORD_DEFAULT);
            
            $update="UPDATE users SET password='$hashed_password' where id='$user_id'";
            $run=mysqli_query($con, $update) or die(mysqli_error($con));
            if($run){
                echo "Password Changed Successfully";
            }
            else{
                echo "Error Changing Password, try again";
            }
        }
        else{
                echo "Password's dont match, check and try again";
        }
    }
    else{
        echo "The old password is incorrect, check & try again";
    }
    
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