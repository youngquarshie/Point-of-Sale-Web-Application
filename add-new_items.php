<?php
include 'includes/connect.php';
include 'includes/header.php';

if($_SESSION['admin_sid']==session_id())
{
    ?>

    <?php
    $item_id=htmlspecialchars($_POST['item_name']);

    $sql=mysqli_query($con,"SELECT item_name FROM tbl_items WHERE item_id=$item_id") or die(mysqli_error($con));
    $fetch=mysqli_fetch_assoc($sql);
    $item_name=$fetch['item_name'];
    $item_qty=htmlspecialchars($_POST['item_qty']);
    $item_price=htmlspecialchars($_POST['item_price']);

    $item_id=mysqli_real_escape_string($con,$_POST['item_name']);
    $item_qty=mysqli_real_escape_string($con,$_POST['item_qty']);
    $item_price=mysqli_real_escape_string($con,$_POST['item_price']);
   
    $insert="INSERT INTO tbl_supplies(item_name, item_qty, item_price, the_date) VALUES ('$item_name', '$item_qty','$item_price',CURRENT_DATE)";
    $run=mysqli_query($con, $insert) or die(mysqli_error($con));
    if($run){
        $update=mysqli_query($con,"UPDATE tbl_items SET item_qty=$item_qty WHERE item_id=$item_id") 
        or die(mysqli_error($con));
    }
    ?>
    <script>
        alert("Added & Updated Item Succesfully");
        window.location.href="supplies.php";
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

