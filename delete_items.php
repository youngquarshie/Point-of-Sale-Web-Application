<?php
include 'includes/connect.php';
//include 'includes/header.php';

if($_SESSION['admin_sid']==session_id())
{
    $item_id=$_GET['item_id'];
    $delete="DELETE FROM tbl_items WHERE item_id=$item_id";
    $run=mysqli_query($con,$delete) or die(mysqli_query($con));
    ?>
    <script>
        alert("Deleted Successfully");
        window.location.href='manage-items.php';
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




