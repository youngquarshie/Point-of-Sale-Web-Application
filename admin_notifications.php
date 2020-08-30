<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
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
                        <li class=""><a href="admin_notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png">Notifications</a></li>
                        <li><a class="dropdown-trigger black-text" href="#!" data-target="dropdown1">Other<img src="images/icons8_Expand_Arrow_48px.png"></a></li>
                        <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_User_48px_1.png">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav white" id="mobile-demo">
            <li class=""><a href="admin_notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png">Notifications</a></li>
            <li class=""><a href="manage-items.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png">Manage Items</a></li>
            <li class=""><a href="admin_sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png">Sales</a></li>
            <li class=""><a href="routers/logout.php"><img src="images/icons8_User_48px_1.png">Logout</a></li>
        </ul>
        <br>

        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            <li class=""><a href="manage-items.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png">Manage Items</a></li>
            <li class=""><a href="admin_sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png">Sales</a></li>
            <li class=""><a href="supplies.php" class="black-text"><img src="images/icons8_Product_48px.png">Supplies</a></li>
            <li class=""><a href="manage-users.php" class="black-text"><img src="images/icons8_User_Groups_48px.png">Manage Users</a></li>
        </ul>
            <br>


            <br>

            <div class="container">

            <div class="right-align">
                    <a href="admin-page.php" class="btn black-text white"><img src="images/icons8_Go_Back_24px.png" style="margin-right: 10px;">BACK</a>
                </div>

                <h4 class="blue-text">Notifications</h4>
                <h6>
                    The following items are running out of stock
                </h6>
                <br>
                <div class="card-panel">
                <table class="responsive-table striped">
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
    if($_SESSION['customer_sid']==session_id())
        {
            header("location:index.php");
        }
        else{
            header("location:login.php");
        }
}
?>

