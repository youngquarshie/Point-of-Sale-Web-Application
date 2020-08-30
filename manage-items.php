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
        
        <button data-target="modal1" class="btn modal-trigger right-align">ADD NEW ITEM</button>
        </div>

        <div class="container">
            <div id="item">

            </div>
            <br>
            <div id="edit">
                    <?php
                    if(isset($_GET['item_id'])){
                        $item_id=$_GET['item_id'];
                        $sql="SELECT * FROM tbl_items WHERE item_id=$item_id";
                        $run=mysqli_query($con, $sql);
                        $row=mysqli_fetch_assoc($run);
                        $item_name=$row['item_name'];
                        $item_qty=$row['item_qty'];
                        $item_price=$row['item_price'];
                        ?>
                        <div class='row'>
                            <h6 class="blue-text">Edit Item</h6>
                            <form method='post' action="update_item.php">
                                <div class="col l5 s12 m12">
                                    Item Name<input type='text' name='item_name' value='<?php echo $item_name; ?>'>
                                </div>
                                <div class="col l2 s12 m12">
                                    Item Quantity<input type='number' name='item_qty' value='<?php echo $item_qty; ?>'>
                                </div>
                                <div class="col l2 s12 m12">
                                    Item Price<input type='number' name='item_price' value='<?php echo $item_price; ?>'>
                                </div>
                                <div class="col l2 s12 m12">
                                    <input type='submit' name='edit' id="update" value='Update' class="btn green">
                                    <input type="hidden" name="item_id" value="<?php echo $item_id?>">
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
                <th>Item Name</th>
                <th>Item Qty</th>
                <th>Item Price</th>
            </tr>
        <?php
        $select="SELECT * FROM tbl_items ORDER BY item_name ASC";
        $run=mysqli_query($con, $select);
        while($fetch=mysqli_fetch_assoc($run)){
            $item_id=$fetch['item_id'];
            $item_name=$fetch['item_name'];
            $item_price=$fetch['item_price'];
            $item_qty=$fetch['item_qty'];

            echo "<tr>";
            echo "<td>"."$item_name"."</td>";
            echo "<td>"."$item_qty"."</td>";
            echo "<td>"."$item_price"."</td>";
            echo "<td>"."<a href='manage-items.php?item_id=$item_id' class='btn-flat green white-text'>Edit</a>"." "." ".
                "<a href='delete_items.php?item_id=$item_id' class='btn-flat red white-text'>Delete</a>"."</td>";
            echo "</tr>";
        }
        ?>
        </table>
        </div>
        <div id="modal1" class="modal">
        <div class="modal-content"> 
        <h6>Add New Item</h6>
        <form method="post" action="add-item.php">
                <div class="col l3">
                    <div class="input-field">
                        <input type="text" name="item_name" class="black-text" placeholder="Item Name" id="item_name">
<!--                        <label>Item Name</label>-->
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="number" name="item_qty" placeholder="Quantity">
<!--                        <label>Item Quantity</label>-->
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="number" name="item_price" placeholder="Price">
                       <label for="item_price">Price</label>
                    </div>
                </div>
                
                

                <button type="submit" class="btn btn-green btn-block">Submit</button>
                </form>
        </div>
       
          
        <script>
                $("#item_name").keyup(function () {
                    var item_name=$("#item_name").val();
                    $.ajax({
                        method:"post",
                        url:"search_item.php",
                        data:{item_name:item_name},
                        success:function (result) {
                            $("#item").html(result);
                        }
                    })
                })

                $(document).ready(function(){

                    //function to show the responsive menu bar
                    $('.sidenav').sidenav();

                    //function to show the dropdown menu
                    $(".dropdown-trigger").dropdown();

                    $(".modal").modal();


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
<style>
.modal{
    background:white;
    width:30%;
}
#update{margin-top:26px;}
</style>
</html>
