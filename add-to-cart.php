<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $invoice_no=$_POST['invoice_no'];
    $item_id=$_POST['item_id'];
    $item_qty=$_POST['item_qty'];

    $check_item_qty="SELECT item_qty from tbl_items WHERE item_id=$item_id";
    $check=mysqli_query($con,$check_item_qty) or die(mysqli_error($con));
    $run_check=mysqli_fetch_assoc($check);
    $real_item_qty=$run_check['item_qty'];
    if($item_qty>$real_item_qty){
        echo "0";
    }
    else{
        $sql="SELECT item_price from tbl_items WHERE item_id=$item_id";
        $run=mysqli_query($con,$sql) or die(mysqli_error($con));
        $fetch=mysqli_fetch_assoc($run);
        $price=$fetch['item_price'];
        $actual_price=$price * $item_qty;

        $insert="INSERT into tbl_cart(item_id,qty_item,invoice_no,price_item,date_added) VALUES ($item_id,$item_qty,$invoice_no,$actual_price,CURRENT_DATE)";
        $run_insert=mysqli_query($con, $insert)or die(mysqli_error($con));

        $update_item="UPDATE tbl_items SET item_qty=item_qty-$item_qty WHERE item_id=$item_id";
        $run_update=mysqli_query($con, $update_item) or die(mysqli_query($con));
        if($run_update){
            echo "1";
        }
    }



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