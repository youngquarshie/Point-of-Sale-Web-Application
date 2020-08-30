<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    $sql="SELECT * FROM tbl_cart";
    $run=mysqli_query($con, $sql);
    $count=mysqli_num_rows($run);


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/header.php'?>
    <body>
    <div class="container-fluid">
        <nav>
            <div class="navbar-fixed">
                <div class="nav-wrapper white">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png"></a>
                    <span class="hide-on-med-and-down">
                    <img src="images/logo.png" width="15%"><a href="admin-page.php" class="brand-logo black-text">
            </span>
                    <ul class="right hide-on-med-and-down">
                        <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
                        <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png"></a></li>
                        <li class=""><a href="cart.php" class="red-text "><img src="images/icons8_Shopping_Cart_48px.png"><?php echo $count;?></a></li>
                        <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
                        <li><a class="dropdown-trigger black-text" href="#!" data-target="dropdown1"><img src="images/icons8_User_48px_1.png"></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">
            <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
            <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png"></a></li>
            <li class=""><a href="cart.php" class="red-text "><img src="images/icons8_Shopping_Cart_48px.png"><?php echo $count;?></a></li>
            <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
            <li><a class="dropdown-trigger black-text" href="#!" data-target="dropdown1"><img src="images/icons8_User_48px_1.png"></a></li>
        </ul>
        <br>

        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            <a class="black-text" href="routers/change_password.php"><img src="images/icons8_User_48px_1.png">Settings</a>
            <a class="black-text" href="routers/logout.php">Logout</a>
        </ul>

        <div class="container">

            <br>

            <br>
            <div class="card-panel">
            <table class="responsive-table">
                <tr>
                    <th>Item Name</th>
                    <th>Item Qty</th>
                    <th>Item Price</th>
                </tr>
                <?php

                $select="SELECT * FROM tbl_cart INNER JOIN tbl_items ON tbl_cart.item_id=tbl_items.item_id";
                $run=mysqli_query($con, $select);
                while($fetch=mysqli_fetch_assoc($run)){
                    $cart_id=$fetch['cart_id'];
                    $item_id=$fetch['item_id'];
                    $item_name=$fetch['item_name'];
                    $item_price=$fetch['price_item'];
                    $item_qty=$fetch['qty_item'];
                    echo "<tr>";
                    echo "<td>"."$item_name"."</td>";
                    echo "<td>"."$item_qty"."</td>";
                    echo "<td>"."$item_price"."</td>";
                    echo "<td>"."<a href='delete-from-cart.php?cart_id=$cart_id' class='btn-floating red white-text'><img src='images/icons8_Minus_48px.png'></a>";
                    echo "</tr>";
                }
                ?>
            </table>

<!--            getting the total number of items-->
            <div>
                <h6>No. of Items: <?php $run="SELECT * FROM tbl_cart";
                                        $row=mysqli_query($con,$run);
                                        $num_rows=mysqli_num_rows($row);
                                        echo $num_rows;
                ?></h6>
            </div>

            <!--            getting the total price-->
            <div>
                <h6>Total Price: <?php
                    $run="SELECT SUM(price_item) FROM tbl_cart";
                    $row=mysqli_query($con,$run);
                    $num_rows=mysqli_fetch_array($row);
                    //var_dump($num_rows);
                    json_encode($num_rows);
                    echo "Ghc"." ".$num_rows["SUM(price_item)"].".00";
                    ?>
                </h6>
            </div>

        </div>
        <script>
            $(document).ready(function(){

                //function to show the responsive menu bar
                $('.sidenav').sidenav();

                //function to show the dropdown menu
                $(".dropdown-trigger").dropdown();


            });

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