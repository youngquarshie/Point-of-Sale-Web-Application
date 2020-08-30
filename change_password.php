<?php
include 'includes/connect.php';

if($_SESSION['admin_sid']==session_id())
{
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/header.php")?>

<body>
<div class="container-fluid">
    <nav>
        <div class="navbar-fixed">
            <div class="nav-wrapper white">
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png"></a>
                <span class="hide-on-med-and-down">
                <a href="admin-page.php"><img src="images/logo.png" width="15%"></a>
            </span>
                <ul class="right hide-on-med-and-down">
                    <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png">Notifications</a></li>
                    <li><a class="dropdown-trigger black-text" href="#!" data-target="dropdown1">Other<img src="images/icons8_Expand_Arrow_48px.png"></a></li>
                    <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_User_48px_1.png">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav white" id="mobile-demo">
        <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png">Notifications</a></li>
        <li class=""><a href="manage-items.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png">Manage Items</a></li>
        <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png">Sales</a></li>
        <li class=""><a href="routers/logout.php"><img src="images/icons8_User_48px_1.png">Logout</a></li>
    </ul>
    <br>

    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li class=""><a href="manage-items.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png">Manage Items</a></li>
        <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png">Sales</a></li>
        <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Product_48px.png">Supplies</a></li>
        <li class=""><a href="manage-users.php" class="black-text"><img src="images/icons8_User_Groups_48px.png">Manage Users</a></li>
    </ul>

    <div class="container">

        <div class="card-panel">
        <div class="row">
            <h6 class="blue-text">Change Password</h6>
                <div class="col l12">
                    <div class="input-field">
                        <input type="password" id="oldpassword" class="black-text" placeholder="Old Password">
                        <!--                        <label>Item Name</label>-->
                    </div>
                </div>

                <div class="col l12">
                    <div class="input-field">
                        <input type="password" id="newpassword" class="black-text" placeholder="New Password">
                        <!--                        <label>Item Name</label>-->
                    </div>
                </div>

                <div class="col l12">
                    <div class="input-field">
                        <input type="password" id="retype_password" class="black-text" placeholder="Retype New Password">
                        <!--                        <label>Item Name</label>-->
                    </div>
                </div>
                <button type="submit" id="change" class="btn green">CHANGE PASSWORD</button>
        </div>
        </div>
    </div>

    <div class="container">
      
        
    </div>
    <script>
        $(document).ready(function(){

            //function to show the responsive menu bar
            $('.sidenav').sidenav();

            //function to show the dropdown menu
            $(".dropdown-trigger").dropdown();

            $("#change").click(function(){
                var user_id="<?php echo $_SESSION['user_id'];?>";
                var oldpassword=$("#oldpassword").val();
                var newpassword=$("#newpassword").val();
                var retype_password=$("#retype_password").val();
      

                $.ajax({
                    url:"update_password.php",
                    method:"post",
                    data:{
                        user_id:user_id,
                        oldpassword:oldpassword,
                        newpassword:newpassword,
                        retype_password:retype_password
                    },
                    success:function(result){
                        alert(result);
                        window.location.href="change_password.php";
                    }
                })
            })

        });

    </script>

    <?php include("includes/script.php")?>

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
</html>
