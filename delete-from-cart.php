<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $cart_id=$_GET['cart_id'];
    $select="SELECT * FROM tbl_cart WHERE cart_id=$cart_id";
    $run=mysqli_query($con, $select) or die(mysqli_error($con));
    $fetch=mysqli_fetch_assoc($run);
    $item_qty=$fetch['qty_item'];
    $item_id=$fetch['item_id'];

    //updating items
    $update_item="UPDATE tbl_items SET item_qty=item_qty + $item_qty WHERE item_id=$item_id";
    $run_update=mysqli_query($con, $update_item) or die(mysqli_query($con));

    //delete items from cart
    $sql="DELETE FROM tbl_cart WHERE cart_id=$cart_id";
    $run=mysqli_query($con,$sql) or die(mysqli_error($con));
    ?>
    <script>
        window.location.href="sell.php";
    </script>
<?php


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
