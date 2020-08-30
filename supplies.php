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
    <button data-target="modal1" class="btn modal-trigger right-align">ADD NEW ITEM</button>

</div>

    <div id="modal1" class="modal">
        <div class="modal-content"> 
        <h6 class="blue-text">Add Item</h6>
            <form method="post" action="add-new_items.php">
                <div class="col l3">
                    <div class="input-field">
                    <select name="item_name" id="item_name">
                            <?php
                            $sql=mysqli_query($con, "SELECT * FROM tbl_items") or die(mysqli_error($con));
                            while($row=mysqli_fetch_assoc($sql)){
                                $item_id=$row['item_id'];
                                $item_name=$row['item_name'];

                                echo "<option value='$item_id'>"."$item_name"."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="number" name="item_qty" placeholder="Item Quantity">
                        <!--                        <label>Item Quantity</label>-->
                    </div>
                </div>

                <div class="col l3">
                    <div class="input-field">
                        <input type="text" name="item_price" placeholder="Item Price">
                        <!--                        <label>Item Quantity</label>-->
                    </div>
                </div>

                <button type="submit" class="btn green" id="Add">ADD</button>

            </form>
        </div>
</div>
    
      

    <div class="container">
        <br>
        <div class="edit">
    <?php
    if(isset($_GET['supply_id'])){
        $supply_id=$_GET['supply_id'];
        $select="SELECT * FROM tbl_supplies WHERE supplier_id=$supply_id";
        $run_edit=mysqli_query($con, $select) or die(mysqli_error($con));
        ?>
        
        <div class="card-panel">
        <h6 class="blue-text">Update</h6>
        <table class="responsive-table">
            <tr>
                <th>Item Name</th>
                <th>Item Qty</th>
                <th>Item Price</th>
            </tr>
            <?php
            while($fetch=mysqli_fetch_assoc($run_edit)){
                $supply_id=$fetch['supplier_id'];
                $item_name=$fetch['item_name'];
                $item_qty=$fetch['item_qty'];
                $item_price=$fetch['item_price'];
                ?>

                <tr>
                <input type='hidden' id='supply_id' value='<?php echo $supply_id?>'>
                <td><input type='text' id='item_name' value='<?php echo $item_name?>'></td>
                <td><input type='number' id='item_qty' value='<?php echo $item_qty?>'></td>
                <td><input type='text' id='item_price' value='<?php echo $item_price?>'></td>
                <td><button type="submit" class='btn-flat green white-text' id='update'>UPDATE</button>
                </tr>
                <?php
            }
            ?>
        </table>

        </div>
            <?php
    }
    ?>
    </div>
        <table class="responsive-table">
            <tr>
                <th>Item Name</th>
                <th>Item Qty</th>
                <th>Item Price</th>
                <th>Date of Supply</th>
            </tr>
            <?php
            $select="SELECT * FROM tbl_supplies ORDER by the_date DESC";
            $run=mysqli_query($con, $select);
            while($fetch=mysqli_fetch_assoc($run)){
                $supply_id=$fetch['supplier_id'];
                $item_name=$fetch['item_name'];
                $item_qty=$fetch['item_qty'];
                $item_price=$fetch['item_price'];
                $the_date=$fetch['the_date'];

                echo "<tr>";
                echo "<td>"."$item_name"."</td>";
                echo "<td>"."$item_qty"."</td>";
                echo "<td>"."$item_price"."</td>";
                echo "<td>"."$the_date"."</td>";
                echo "<td>"."<a href='supplies.php?supply_id=$supply_id' class='btn-flat green white-text'>Edit</a>"." "." ";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <script>

    $("#update").click(function(){
        var supply_id=$("#supply_id").val();
        var item_name=$("#item_name").val();
        var item_price=$("#item_price").val();
        var item_qty=$("#item_qty").val();

        $.ajax({
            url:"edit_supply.php",
            method:"post",
            data:{
                supply_id:supply_id,
                item_name:item_name,
                item_price:item_price,
                item_qty:item_qty
            },
            success:function(result){
                alert(result);
                window.location.href="supplies.php";
            }
        })
    })
        $(document).ready(function(){

            $(".modal").modal();

            //function to show the responsive menu bar
            $('.sidenav').sidenav();

            //function to show the dropdown menu
            $(".dropdown-trigger").dropdown();

            $("#item_name").formSelect();


        });

    </script>

    <?php include("includes/script.php")?>
    <style>#Add{margin-top:26px;}</style>


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
