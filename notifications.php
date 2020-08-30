<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $sql="SELECT * FROM tbl_cart";
    $run=mysqli_query($con, $sql);
    $count=mysqli_num_rows($run);

    $get_notification="SELECT * FROM tbl_items WHERE item_qty <= 10";
    $query=mysqli_query($con, $get_notification);
    $notification=mysqli_num_rows($query);


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/header.php'?>
    <div>
        <div class="container-fluid">
            <nav>
                <div class="navbar-fixed">
                    <div class="nav-wrapper white">
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png"></a>
                        <span class="hide-on-med-and-down">
                        <img src="images/logo.png" width="15%"><a href="admin-page.php" class="brand-logo black-text">

            </span>
                        <ul class="right hide-on-med-and-down">
                            <ul class="right hide-on-med-and-down">
                                <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
                                <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
                                <li class="red-text"><img src="images/icons8_Shopping_Cart_24px.png"><?php echo $count;?></li>
                                <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
                                <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_Sign_Out_48px.png"></a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </nav>

            <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">
                <ul class="right hide-on-med-and-down">
                    <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
                    <li class=""><a href="notifications.php" class="red-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
                    <li class="red-text"><img src="images/icons8_Shopping_Cart_24px.png"><?php echo $count;?></li>
                    <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
                    <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_Sign_Out_48px.png"></a></li>
                </ul>
            </ul>
            <br>


            <br>

            <div class="container">
                <h4 class="blue-text">Notifications</h4>
                <h6>
                    The following items are running out of stock
                </h6>
                <br>
                <div class="card-panel">
                <table class="responsive-table">
                    <tr>
                        <th>Item Name</th>
                        <th>Item Qty</th>
                        <th>Item Price</th>

                    </tr>

                    <?php
                    $select="SELECT * FROM tbl_items WHERE item_qty <= 10";
                    $run=mysqli_query($con, $select);
                    while($fetch=mysqli_fetch_assoc($run)){
                        $item_qty=$fetch['item_qty'];
                        $item_name=$fetch['item_name'];
                        $item_price=$fetch['item_price'];

                        echo "<tr>";
                        echo "<td>"."$item_name"."</td>";
                        echo "<td>"."$item_qty"."</td>";
                        echo "<td>"."$item_price"."</td>";
                        echo "</tr>";
                    }

                    $select="SELECT * FROM tbl_items WHERE item_qty <= 10";
                    $run=mysqli_query($con, $select);
                    $rows=mysqli_num_rows($run);
                    echo "<b>Total Items:".$rows."</b>";
                    ?>
                </table>
</div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.sidenav').sidenav();

                //function to show the dropdown menu
                $(".dropdown-trigger").dropdown();

            })

        </script>

        <script src="materialize/js/materialize.min.js"></script>


    </html>
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

