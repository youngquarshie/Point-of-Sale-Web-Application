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
                    <a href="admin-page.php"><img src="images/logo.png" width="15%"></a>

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
                <div class="right-align">
                    <a href="admin_sales.php" class="btn black-text white"><img src="images/icons8_Go_Back_24px.png" style="margin-right: 10px;">BACK</a>
                </div>
                <h4>Sales</h4>
                <br>
                <div class="row">
                    <h6 class="blue-text"><b>Generate Sales By Month</b></h6>
                    <div class="col l5">
                        <div class="input-field">
                            <select id="month">
                                <option selected disabled>Choose Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                    <div class="col l5">
                        <button type="submit" class="btn green" id="search">Search</button>
                    </div>
                </div>
            </div>

            <!--                ///displaying sales lists-->
            <div class="container">
                <div id="drug">

                </div>
            </div>

        <script>

            

            //searching for item
            $("#search").click(function () {
                var sale_date=$("#sale_date").val();
                //alert(sale_date);
                $.ajax({
                    method:"post",
                    url:"admin_search_sales.php",
                    data:{sale_date:sale_date},
                    success:function (result) {
                        $("#item").html(result);
                    }
                })
            });

            $(document).ready(function () {

                $("#month").formSelect();


            //searching for item
            $("#search").click(function () {
                var sale_month=$("#month").val();
                //alert(sale_month);
                if(sale_month==""){
                    alert("No Month selected");
                    exit();
                }
                //alert(sale_date);
                $.ajax({
                    method:"post",
                    url:"search_monthly_sales.php",
                    data:{sale_month:sale_month},
                    success:function (result) {
                        $("#drug").html(result);
                    }
                })
            });


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

    #search{
            margin-top: 22px;
        }
</style>
