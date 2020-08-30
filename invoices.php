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

            <div class="container">
                <h5>Invoices</h5>
                <br>
                <div class="row">
                    <h6 class="blue-text"><b>Search</b></h6>
                    <div class="col l5">
                        <div class="input-field">
                            <input type="text" name="sale" class="black-text" placeholder="Invoice ID" id="invoice">
                            
                        </div>
                        <button type="submit" class="btn green" id="search">Search</button>
                    </div>
                </div>
            </div>

            <div class="container">

<!--                ///displaying sales lists-->
                <div id="invoice_id">

                </div>

                <div>
                    <h6><?php
                        ?>
                    </h6>
                </div>

            </div>
        </div>

        <script>

            //searching for item
            $("#search").click(function () {
                var invoice=$("#invoice").val();
                //alert(invoice);
                $.ajax({
                    method:"post",
                    url:"invoice_sales.php",
                    data:{invoice:invoice},
                    success:function (result) {
                        //alert(result);
                        $("#invoice_id").html(result);
                    }
                })
            });

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
<style>
    placeholder{
        font-size:15px;
    }
</style>
