<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id()) {
    $invoice_no=$_POST['invoice_no'];
    $item_name = strtoupper($_POST['item_name']);
    $search = "SELECT * FROM tbl_items WHERE item_name='$item_name'";
    $run = mysqli_query($con, $search) or die(mysqli_errror($con));
    ?>
    <html>

    <?php include 'includes/header.php'?>
    <body>

    <?php
    while($fetch = mysqli_fetch_assoc($run)){
    $item_id = $fetch['item_id'];
    $item_name = $fetch['item_name'];
    $item_price = $fetch['item_price'];
    ?>
    <table class="responsive-table">
            <tr>
                <th>Item Name</th>
                <th>Item Qty</th>
                <th>Item Price</th>
            </tr>
            <?php
            echo "<tr>";
            echo "<td>" . "$item_name" . "</td>";
            echo "<td>" . "<input type='number' name='item_qty' value='1' class='item_qt'>" . "</td>";
            echo "<td>" . "$item_price" . "</td>";
            echo "<td>" . "<input type='hidden' name='text' class= 'id' value='$item_id'" . "</td>";
            echo "<td>" . "<button type='submit' name='add' id='add' class='btn green'>ADD TO CART</button>";;
            echo "</tr>";
            }
    ?>
    </table>
    <?php
    if(!$fetch){
        echo "";
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
    <script>
         $("#add").click(function () {
             var item_id = $(this).closest("tr").find(".id").val();
             var item_qty = $(this).closest("tr").find(".item_qt").val();
             var invoice_no="<?php echo $_POST['invoice_no'];?>";


             $.ajax({
                 method:"post",
                 url:"add-to-cart.php",
                 data:{item_qty:item_qty,item_id:item_id, invoice_no:invoice_no},
                 success:function (cart) {
                     alert(cart);
                     window.location.href="sell.php";
                 }
             })
        })
    </script>
    </html>

