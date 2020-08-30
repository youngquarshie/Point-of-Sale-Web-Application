<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $item_qty=$_POST['item_qty'];
    $item_id=$_POST['item_id'];
    $sql="SELECT item_price from tbl_items WHERE item_id=$item_id";
    $run=mysqli_query($con,$sql) or die(mysqli_error($con));
    $fetch=mysqli_fetch_assoc($run);
    $price=$fetch['item_price'];
    $actual_price=$price * $item_qty;
    echo $actual_price;

}
else
{
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin-page.php");
    }
    else{
        header("location:login.php");
    }
}
?>
