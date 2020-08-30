<?php
include 'includes/connect.php';
include 'includes/header.php';

	if($_SESSION['admin_sid']==session_id())
    {
        ?>

        <?php
        $item_name=strtoupper($_POST['item_name']);
        $item_qty=$_POST['item_qty'];
        $item_price=$_POST['item_price'];
        
        

        $select="SELECT * FROM tbl_items WHERE item_name='$item_name'";
        $query=mysqli_query($con, $select) or die(mysqli_error($con));
        $fetch=mysqli_fetch_assoc($query);
        if($fetch){
            ?>
            <script>
                alert("Existing Item Already Exist");
                window.location.href="manage-items.php";
            </script>
            <?php
        }
        else{
            $insert="INSERT INTO tbl_items (item_name, item_qty, item_price, date_added) VALUES ('$item_name', $item_qty, $item_price, NOW())";
            $run=mysqli_query($con, $insert) or die(mysqli_error($con));
        }
        ?>
        <script>
            alert("Added Succesfully");
            window.location.href="manage-items.php";
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

