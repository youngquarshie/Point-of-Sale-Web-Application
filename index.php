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
    <body>
    <div class="container-fluid">
        <nav>
            <div class="navbar-fixed">
                <div class="nav-wrapper white">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png">></a>
                    <span class="hide-on-med-and-down">
                    <a href="index.php" class="brand-logo black-text"><img src="images/logo.png" width="15%"></a>
            </span>
                    <ul class="right hide-on-med-and-down">
                        <li class="black-text">
                            Welcome <?php echo $_SESSION['name'];?></a>
                        </li>

                        <li>
                            <a class="black-text" href="routers/logout.php"><img src="images/icons8_Sign_Out_48px.png"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">

        </ul>
        <br>

        <div class="container">
            <br>
            <div class="row">

                <!-- manage items -->
                <a href="sell.php" class="black-text">
                    <div class="col l3 m3 s12">
                        <div class="card-panel hoverable white">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Shopping_Basket_48px.png">
                                </div>
                                <h6>Sell</h6>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- notifications -->
                <a href="notifications.php" class="black-text">
                    <div class="col l3 m3 s12">
                        <div class="card-panel hoverable waves-green white">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Notification_48px.png"><?php echo $notification;?>
                                </div>

                                <h6>Notifications</h6>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="seller_invoices.php" class="white-text">
                    <div class="col l3">
                        <div class="card-panel hoverable white black-text">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Bill_48px.png">
                                </div>
                                <h6>Invoices</h6>
                            </div>
                        </div>
                    </div>
                </a>



                <!-- Manage sales -->
                <a href="sales.php" class="black-text">
                    <div class="col l3 m3 s12">
                        <div class="card-panel hoverable white">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Sales_Performance_48px.png">
                                </div>
                                <h6>Sales</h6>
                            </div>
                        </div>
                    </div>
                </a>

<!--                <!-- Manage supplies-->
<!--                <a href="change_password.php" class="white-text">-->
<!--                    <div class="col l3 m3 s12">-->
<!--                        <div class="card-panel hoverable purple">-->
<!--                            <div class="card-content">-->
<!--                                <div class="card-image">-->
<!--                                    <img src="images/icons8_Product_48px.png">-->
<!--                                </div>-->
<!--                                <h6>Change Password</h6>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
            </div>

            <script src="materialize/js/materialize.min.js"></script>
            <script>
                $(document).ready(function(){

                    //function to show the responsive menu bar
                    $('.sidenav').sidenav();

                    //fucntion to show the slideshow image
                    $('.slider').slider();


                });
            </script>
        </div>

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