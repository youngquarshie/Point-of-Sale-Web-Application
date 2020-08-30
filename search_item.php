<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
{
    $item_name=strtoupper($_POST['item_name']);

    $search="SELECT * FROM tbl_items WHERE item_name='$item_name'";
    $run=mysqli_query($con, $search) or die(mysqli_errror($con));
    $fetch=mysqli_fetch_assoc($run);
    if($fetch){
        echo "<h6 class='red-text'>"."$item_name".":"." "."Already"." "."Exist"."</h6>";
    }

    if(!$fetch){
        echo "";
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

include 'includes/script.php';
?>




