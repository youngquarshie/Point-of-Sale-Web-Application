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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0"/>
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <link rel="icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap-sweetalert-master/dist/sweetalert.min.js"></script>
    <link href="bootstrap-sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <title>POS</title>
</head>
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
                        <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
                        <li class=""><a href="notifications.php" class="red-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
                        <li class="red-text"><img src="images/icons8_Shopping_Cart_24px.png"><?php echo $count;?></li>
                        <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
                        <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_Sign_Out_48px.png"></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">
            <li class=""><a href="sell.php" class="black-text"><img src="images/icons8_Shopping_Basket_48px.png"></a></li>
            <li class=""><a href="notifications.php" class="black-text"><img src="images/icons8_Notification_48px.png"><?php echo $notification;?></a></li>
            <li class="red-text"><img src="images/icons8_Shopping_Cart_48px.png"><?php echo $count;?></li>
            <li class=""><a href="sales.php" class="black-text"><img src="images/icons8_Sales_Performance_48px.png"></a></li>
            <li class=""><a href="routers/logout.php" class="black-text"><img src="images/icons8_Sign_Out_48px.png"></a></li>
        </ul>
        <br>

        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            <a class="black-text" href="routers/change_password.php"><img src="images/icons8_User_48px_1.png">Settings</a>
            <a class="black-text" href="routers/logout.php">Logout</a>
        </ul>



        <div class="container">
            

            <?php
            $select="SELECT * FROM tbl_invoice";
            $run=mysqli_query($con, $select) or die(mysqli_error($con));
            $fetch=mysqli_fetch_assoc($run);
            $invoice_id=$fetch['invoice_id'];
            $invoice_no=$fetch['invoice_no'];
            ?>
            <?php if(!isset($_SESSION['invoice_no'])){
                ?>
            <form action="sell.php" method="post">
                <div class="row">
                    <div class="col l2">
                    <div class="input-field">
                        <input type="hidden" name="invoice_no" value="<?php echo $invoice_no; ?>" readonly>
                    </div>
                </div>
                <button type="submit" name="generate" class="btn green col l9">Generate Order</button>
            </form>
        </div>
        <?php
        }
        ?>

<?php
if(isset($_POST['generate'])){
    //$_SESSION['invoice_id']=$_POST['invoice_id'];
    $_SESSION['invoice_no']=$_POST['invoice_no'];
    header("location:sell.php");
}
?>

        </div>
        <?php
        if(isset($_SESSION['invoice_no'])) {

            ?>
            <!-- displaying cart-->
            <div class="container">
                <div class="card-panel" id="area">
                    <table class="responsive-table">
                        <h6 class="blue-text">Order</h6>
                        <!--            getting the invoice number-->
                        <div>
                            <h6>Invoice No: <?php
                                echo $invoice=$_SESSION['invoice_no'];
                                ?>
                            </h6>
                        </div>
                        <tr>
                            <th>Item Name</th>
                            <th>Item Qty</th>
                            <th>Item Price</th>
                        </tr>
                        <?php

                        $select = "SELECT * FROM tbl_cart INNER JOIN tbl_items ON tbl_cart.item_id=tbl_items.item_id";
                        $run = mysqli_query($con, $select);
                        while ($fetch = mysqli_fetch_assoc($run)) {
                            $cart_id = $fetch['cart_id'];
                            $item_id = $fetch['item_id'];
                            $item_name = $fetch['item_name'];
                            $item_price = $fetch['price_item'];
                            $item_qty = $fetch['qty_item'];
                            echo "<tr>";
                            echo "<td>" . "$item_name" . "</td>";
                            echo "<td>" . "$item_qty" . "</td>";
                            echo "<td>" . "$item_price" . "</td>";
                            echo "<td>" . "<a href='delete-from-cart.php?cart_id=$cart_id' class='white-text'><img src='images/icons8_Minus_24px.png'></a>";
                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <!--            getting the total number of items-->
                    <div>
                        <h6><b>No. of Items:</b> <?php $run = "SELECT * FROM tbl_cart";
                            $row = mysqli_query($con, $run);
                            $num_rows = mysqli_num_rows($row);
                            echo $num_rows;
                            ?></h6>
                    </div>

                    <!--            getting the total price-->
                    <div>
                        <h6><b>Total Price:</b> <?php
                            $run = "SELECT SUM(price_item) FROM tbl_cart";
                            $row = mysqli_query($con, $run);
                            $num_rows = mysqli_fetch_array($row);
                            //var_dump($num_rows);
                            json_encode($num_rows);
                            echo "Ghc" . " " . $num_rows["SUM(price_item)"];

                            ?>
                        </h6>
                    </div>
                    <!--            getting the total price-->
                    <div class="right-align">
                        <a href="process.php?invoice_id=<?php echo $invoice?>" class="" name="done"><img src="images/icons8_Ok_48px_1.png"></a>
                    </div>
                    <br>     
                    <div class="left-align">
                        <a href="print_order.php?invoice_no=<?php echo $_SESSION['invoice_no'];?>" class="" id="print"><img src="images/icons8_Print_48px.png"></a>
                    </div>
                    <!--                       customer id-->
                </div>
            </div>

            <br><br>

            <div class="container">
                <div class="container">
                    <div class="card-panel">
                <div class="row">
                    <h6 class="blue-text"><b>Search Items</b></h6>
                    <div class="col l12">
                        <div class="input-field">
                            <input type="text" name="item_name" class="black-text" placeholder="Item Name"
                                   id="item_name">
                            <!--                        <label>Item Name</label>-->
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div id="item">

                </div>

                <br>
                <br>
                <div class="card-panel">
                <table class="responsive-table" id="items">
                    <tr>
                        <th>Item Name</th>
                        <th>Item Qty</th>
                        <th>Item Price</th>
                    </tr>

                    <?php
                    $select = "SELECT * FROM tbl_items ORDER BY item_name ASC";
                    $run = mysqli_query($con, $select);
                    while ($fetch = mysqli_fetch_assoc($run)) {
                        $item_id = $fetch['item_id'];
                        $item_name = $fetch['item_name'];
                        $item_price = $fetch['item_price'];

                        echo "<tr>";
                        echo "<td>" . $item_name . "</td>";
                        echo "<td>" . "<input type='number' class='item_qty' value='1'>" . "</td>";
                        echo "<td>" . "Ghc"." ".$item_price. "</td>";
                        echo "<td>" . "<input type='hidden' name='text' class= 'idx' value='$item_id'" . "</td>";
                        echo "<td>" . "<button type='submit' class='btn btn-floating white'><img src='images/icons8_Shopping_Cart_24px.png'></button>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                </div>
            </div>
            <?php
        }
         ?>
    </div>
        <script>
            $("#item_name").keyup(function () {
                var item_name=$("#item_name").val();
                var invoice_no="<?php echo $_SESSION['invoice_no'];?>";
                $.ajax({
                    method:"post",
                    url:"search_item_to_sell.php",
                    data:{item_name:item_name,invoice_no:invoice_no},
                    success:function (result) {
                        $("#item").html(result);
                    }
                })
            });

            $(document).ready(function () {
                $('.sidenav').sidenav();

                //function to show the dropdown menu
                $(".dropdown-trigger").dropdown();

                $(".btn").click(function () { 
                    
                    var item_id = $(this).closest("tr").find(".idx").val();
                    var item_qty = $(this).closest("tr").find(".item_qty").val();
                    var invoice_no="<?php echo $_SESSION['invoice_no'];?>";
                    // swal("success",invoice_no,"");
                    //exit();

                    $.ajax({
                        method:"post",
                        url:"add-to-cart.php",
                        data:{item_qty:item_qty,item_id:item_id, invoice_no:invoice_no},
                        success:function (cart) {
                            // alert(cart);
                            if(cart==="0"){
                                swal("","The number of items in stock is less than the number of items selected","error");
                            setTimeout(function(){
                                window.location.href="sell.php";
                            },3000)

                            }
                            else{
                                swal("","Added to Cart","success");
                            setTimeout(function(){
                                window.location.href="sell.php";
                            },3000)
                            }
                            
                                
                        }
                    })

                });

                

               
            })

        </script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        

        

        


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

    /* #area{
        max-width:320px !important;
        max-height:auto;
    } */

    
</style>
