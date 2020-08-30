<?php
include 'includes/connect.php';

	if($_SESSION['admin_sid']==session_id())
	{
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
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png"></a>
                    <span class="hide-on-med-and-down">
            <a href="admin-page.php" ><img src="images/logo.png" width="15%"></a>
            </a>
            </span>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a class="black-text" href="routers/logout.php"><img src="images/icons8_User_48px_1.png">Logout</a>
                        supplies</li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">

        </ul>
        <br>

        <div class="container">

        <div class="row">
                <div class="col l3">
                    <div class="card-panel waves-green blue">
                        <div class="card-content">
                            <h6 class="white-text">Total Sales:<span><?php
                                    $run = "SELECT SUM(item_price) FROM tbl_sales";
                                    $row = mysqli_query($con, $run);
                                    $num_rows = mysqli_fetch_array($row);
                                    //var_dump($num_rows);
                                    json_encode($num_rows);
                                    echo "<h6 class='white-text'>"."Ghc" . " " . $num_rows["SUM(item_price)"]."</h6>";
                                    ?></span></h6>

                        </div>
                    </div>
                </div>
    </div>

            <div class="row">
                <!-- notifications -->
                <a href="admin_notifications.php" class="black-text">
                    <div class="col l3">
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


                <!-- manage items -->
                <a href="manage-items.php" class="black-text ">
                <div class="col l3">
                    <div class="card-panel hoverable white">
                        <div class="card-content">
                            <div class="card-image">
                                <img src="images/icons8_Shopping_Basket_48px.png">
                            </div>
                            <h6>Manage Items</h6>
                        </div>
                    </div>
                </div>
                </a>

                <!-- Manage sales -->
                <a href="admin_sales.php" class="black-text">
                    <div class="col l3">
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

                <!--Manage supplies-->
                <a href="supplies.php" class="black-text">
                    <div class="col l3">
                        <div class="card-panel hoverable white">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Product_48px.png">
                                </div>
                                <h6>Supplies</h6>
                            </div>
                        </div>
                    </div>
                </a>

                <!--IINVOICES-->
                <a href="invoices.php" class="white-text">
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

                <a href="manage-users.php" class="black-text">
                    <div class="col l3">
                        <div class="card-panel hoverable white lighten-1">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_User_Groups_48px.png">
                                </div>
                                <h6>Manage Users</h6>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="change_password.php" class="black-text">
                    <div class="col l3">
                        <div class="card-panel hoverable white lighten-1">
                            <div class="card-content">
                                <div class="card-image">
                                    <img src="images/icons8_Password_48px.png">
                                </div>
                                <h6>Change Password</h6>
                            </div>
                        </div>
                    </div>
                </a>

            </div>



            <div class="row">
               
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