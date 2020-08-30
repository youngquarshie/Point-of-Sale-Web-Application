<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $invoice_no=$_GET['invoice_id'];
    
    $check=mysqli_query($con, "SELECT * FROM tbl_cart WHERE invoice_no=$invoice_no") or die(mysqli_error($con));
    $run_check=mysqli_num_rows($check);

    // echo $run_check;
    
    if(!$run_check>0){
        ?>
        <script>alert("The Cart is Empty");
        window.location.href="sell.php";
        </script>
        <?php
    }
    else{
        $_SESSION['invoice_no']=$_GET['invoice_id'];
    $the_invoice=$_SESSION['invoice_no'];
    $sql="INSERT into tbl_sales(item_id,invoice_no,item_qty,item_price,sale_date) 
          SELECT item_id,invoice_no,qty_item,price_item, date_added FROM tbl_cart";
    $run=mysqli_query($con,$sql) or die(mysqli_error($con));
    $delete=mysqli_query($con,"DELETE FROM tbl_cart") or die(mysqli_query());

    $rand=mt_rand(10,500000);
    $new_invoice= 1 *$rand;

    $update=mysqli_query($con,"UPDATE tbl_invoice SET invoice_no=$new_invoice WHERE invoice_id=1") or die(mysqli_query());
    unset($_SESSION['invoice_no']);
    header("location:sell.php");
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