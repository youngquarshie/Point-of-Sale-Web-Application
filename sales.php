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
                        <a href="sales.php" ><img src="images/logo.png" width="15%"></a>

            </span>
                        <ul class="right hide-on-med-and-down">
                            <ul class="right hide-on-med-and-down">
                                <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
                                <li class=""><a href="notifications.php" class="red-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
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
                    <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
                    <li class="red-text"><img src="images/icons8_Shopping_Cart_24px.png"><?php echo $count;?></li>
                    <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
                    <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_Sign_Out_48px.png"></a></li>
                </ul>
            </ul>
            <br>

            <div class="container">
                <h4>Sales</h4>
                <br>
                <div class="row">
                    <h6 class="blue-text"><b>Search</b></h6>
                    <div class="col l8">
                        <div class="input-field">
                            <input type="date" name="sale" class="black-text" placeholder="Item Name" id="sale_date">
                            <button type="submit" class="btn green" id="search">Search</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">


<!--                ///displaying sales lists-->
                <div id="item">

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
                var sale_date=$("#sale_date").val();
                //alert(sale_date);
                $.ajax({
                    method:"post",
                    url:"search_for_sales.php",
                    data:{sale_date:sale_date},
                    success:function (result) {
                        $("#item").html(result);
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
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin-page.php");
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
