<?php  
session_start(); 
if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']))
{
	header("location:index.php");
}
else{
?>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0"/>
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel="icon" href="images/logo.png">
        <link href="bootstrap-sweetalert-master/dist/sweetalert.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/jquery-3.2.1.min.js"></script>
        <title>POS</title>
    </head>
    <body>
    <div class="container-fluid">
        <nav>
            <div class="navbar-fixed">
                <div class="nav-wrapper white">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><img src="images/icons8_Menu_48px_1.png"></a>
                    <span class="hide-on-med-and-down">
                    <a href="login.php"> <img src="images/logo.png" width="15%"></a>
            </span>
                    <ul class="right hide-on-med-and-down">
<!--                        <li class="active black"><a href="#">HOME</a></li>-->
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav #ab47bc #fafafa grey lighten-5" id="mobile-demo">

        </ul>
        <br><br><br>

        <div class="container">
            <div id="login-page" class="row">
                <div class="card horizontal col l10">
                    <div class="card-image">
                        <img src="images/super.jpg" class="responsive-img">
                    </div>
                <div class="col l12">
                    <form method="post" action="routers/router.php" class="login-form" id="form">
                        <div class="row">
                            <div class="input-field col s12 l12">
                                <input name="username" id="username" type="text" required>
                                <label for="username" class="center-align">Username</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 l12">
                                <input name="password" id="password" type="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" onclick="document.getElementById('form').submit();" class="btn teal col l3 push-l5 waves-button-input">Login</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>


        <br>
    <br><br><br><br><br><br><br>
        
        <style>

        </style>
        <script>
            $(document).ready(function(){

                //function to show the responsive menu bar
                $('.sidenav').sidenav();

                //fucntion to show the slideshow image
                $('.slider').slider();


            });
        </script>

    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>


</body>
</html>
<?php
}
?>