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
                <img src="images/logo.png" width="15%"><a href="admin-page.php" class="brand-logo black-text">

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
        <div class="row">
            
            <a class="btn blue modal-trigger" href="#modal1">ADD NEW USER</a>

           
            
        </div>
    </div>

   <div id="modal1" class="modal">
       <div class="modal-content">
        <h6>Add New User</h6>
        <form method="post" action="add-user.php">
                <div class="col l3">
                    <div class="input-field">
                        <select name="role" id="user_role">
                            <option>Administrator</option>
                            <option>Customer</option>
                        </select>
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="text" name="name" placeholder="Name">
                        <!--                        <label>Item Quantity</label>-->
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Username">
                        <!--                        <label>Item Quantity</label>-->
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password">
                        <!--                        <label>Item Price</label>-->
                    </div>
                </div>

                <button type="submit" class="btn green modal-trigger">ADD</button>

            </form>
       </div>
   </div> 

    

    <div class="container">
        <br>
        <div id="edit">
            <?php
            if(isset($_GET['user_id'])){
                $user_id=$_GET['user_id'];
                $sql="SELECT * FROM users WHERE id =$user_id";
                $run=mysqli_query($con, $sql);
                $row=mysqli_fetch_assoc($run);
                $name=$row['name'];
                $username=$row['username'];
                $role=$row['role'];
                $password=$row['password'];
                ?>
                <div class='row'>
                    <h6 class="blue-text">Edit User</h6>
                    <form method='post' action="update_user.php">
                        <div class="col l5 s12 m12">
                            Name:<input type='text' name='name' value='<?php echo $name;?>'>
                        </div>
                        <div class="col l2 s12 m12">
                            Username:<input type='text' name='username' value='<?php echo $username;?>'>
                        </div>
                        <div class="col l2 s12 m12">
                            Password:<input type='text' name='password' value='<?php echo $password;?>'>
                        </div>
                        <div class="col l2 s12 m12">
                            Role:<input type='text' name='role' value='<?php echo $role;?>' readonly>
                        </div>
                        <div class="col l2 s12 m12">
                            <input type='submit' name='edit' value='Update' class="btn green">
                            <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                        </div>
                    </form>
                </div>

                <?php
            }
            ?>
        </div>
        <br>
        <table class="responsive-table">
            <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <?php
            $select="SELECT * FROM users ORDER BY username ASC";
            $run=mysqli_query($con, $select);
            while($fetch=mysqli_fetch_assoc($run)){
                $user_id=$fetch['id'];
                $role=$fetch['role'];
                $name=$fetch['name'];
                $username=$fetch['username'];
                $password=$fetch['password'];

                echo "<tr>";
                echo "<td>"."$role"."</td>";
                echo "<td>"."$name"."</td>";
                echo "<td>"."$username"."</td>";
                echo "<td>"."$password"."</td>";
                echo "<td>"."<a href='manage-users.php?user_id=$user_id' class='btn-flat green white-text'>Edit</a>"." "." ".
                    "<a href='delete_users.php?user_id=$user_id' class='btn-flat red white-text'>Delete</a>"."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <script>

        $(document).ready(function(){

            //function to show the responsive menu bar
            $('.sidenav').sidenav();

            //function to show the dropdown menu
            $(".dropdown-trigger").dropdown();

            $("#modal1").modal();

            $("#modal2").modal();

            $("#user_role").formSelect();    

        });

    </script>
    <style>
        .modal{
    background:white;
    width:30%;
}
        </style>

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
