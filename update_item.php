<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
{
if(isset($_POST['edit'])){
    $item_id=$_POST['item_id'];
    $item_name=htmlspecialchars($_POST['item_name']);
    $item_qty=htmlspecialchars($_POST['item_qty']);
    $item_price=htmlspecialchars($_POST['item_price']);

    $sql="UPDATE tbl_items SET item_name='$item_name', item_qty=$item_qty, item_price=$item_price WHERE item_id=$item_id";
    $run=mysqli_query($con, $sql) or die(mysqli_error($con));
    if($run){
        ?>
        <script>
            swal("success","Updated Successfully");
            window.location.href='manage-items.php?item_id=<?php echo $item_id?>';
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("Error Updating Item, Try Again");
            window.location.href='manage-items.php?item_id=<?php echo $item_id?>';
        </script>
        <?php
    }

}

?>

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
?>