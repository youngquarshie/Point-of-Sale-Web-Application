<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id()) {
$sale_date = $_POST['sale_date'];
$search = "SELECT tbl_sales.sale_id,tbl_sales.item_price, tbl_sales.item_qty, tbl_sales.item_id,tbl_sales.sale_date, 
tbl_items.item_name FROM tbl_sales INNER JOIN tbl_items ON tbl_sales.item_id=tbl_items.item_id 
WHERE sale_date='$sale_date'";
$run = mysqli_query($con, $search) or die(mysqli_error($con));
?>

<?php include 'includes/header.php'?>
<body>
<table class="responsive-table">
    <tr>
        <th>Item Name</th>
        <th>Item Qty</th>
        <th>Item Price</th>
        <th>Sale Date</th>
    </tr>
<?php
while($fetch = mysqli_fetch_assoc($run)){
$item_id = $fetch['item_id'];
$item_name = $fetch['item_name'];
$item_price = $fetch['item_price'];
$item_qty = $fetch['item_qty'];

?>
        <?php
        echo "<tr>";
        echo "<td>" . "$item_name" . "</td>";
        echo "<td>" . "$item_qty" . "</td>";
        echo "<td>" . "$item_price" . "</td>";
        echo "<td>" . "$sale_date" . "</td>";
        echo "</tr>";
        }

        $run="SELECT SUM(item_price) FROM tbl_sales where sale_date='$sale_date'";
$row=mysqli_query($con,$run);
$num_rows=mysqli_fetch_array($row);
//var_dump($num_rows);
json_encode($num_rows);
echo "<b>Total Sales:Ghc </b>".""." ".$num_rows["SUM(item_price)"];
echo "<br>";
echo "<br>";
$run="SELECT * FROM tbl_sales where sale_date='$sale_date'";
$row=mysqli_query($con,$run);
$num_rows=mysqli_num_rows($row);
echo "<b>Total Items:</b>".""."<b>".$num_rows."<b>";
echo "<br>";

        ?>
</table>
<?php
if(!$run){
    echo "No result found";
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
</body>

</html>

