
<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id()) {
    $supply_id=$_POST['supply_id'];
    $item_name=$_POST['item_name'];
    $item_qty=$_POST['item_qty'];
    $item_price=$_POST['item_price'];

    $sql="UPDATE tbl_supplies SET supplier_id=$supply_id, item_name='$item_name', item_qty=$item_qty, item_price=$item_price";
    $update=mysqli_query($con, $sql) or die(mysqli_error($con));
    if($update){
        echo "Updated Successfully";
    }
    else{
        echo "Error Updating";
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