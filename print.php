<?php
if($_SESSION['customer_sid']==session_id()) {

    $select = "SELECT * FROM tbl_cart INNER JOIN tbl_items ON tbl_cart.item_id=tbl_items.item_id";
    $run = mysqli_query($con, $select);
    while ($fetch = mysqli_fetch_assoc($run)) {
        $cart_id = $fetch['cart_id'];
        $item_id = $fetch['item_id'];
        $item_name = $fetch['item_name'];
        $item_price = $fetch['price_item'];
        $item_qty = $fetch['qty_item'];
        "<tr>";
        "<td>" . "$item_name" . "</td>";
        "<td>" . "$item_qty" . "</td>";
        "<td>" . "$item_price" . "</td>";
        "</tr>";
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
