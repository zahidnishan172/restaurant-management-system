<?php

require_once '../src/database.php';
$breakfast = db_select("select * from foodmenu where type='breakfast' limit 0,3");
$lunch = db_select("select * from foodmenu where type='lunch' limit 0,3");
$snack = db_select("select * from foodmenu where type='snacks' limit 0,3");
$dinner = db_select("select * from foodmenu where type='dinner' limit 0,3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .contact-item{
            color: #F4F4F4;
        }

    </style>
</head>
<body style="background-color: #CCCCCC">

<nav class="navbar navbar-inverse navbar-fixed-top on" style="margin-bottom: 50px">
    <div class="container-fluid" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: #00CC00;font-size: 30px;font-family: 'Harlow Solid Italic'">WE HUNGRY</a>
        </div>
        <?php
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }
        ?>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../Public/index.php">Home</a></li>
                <li><a href="../Public/food-menu-public.php">Food Menu</a></li>

                <?php
                if(isset($_SESSION['type'])&&!strcmp($_SESSION['type'],'admin')){
                    ?>

                    <li><a href="../Admin/food-menu-admin.php">Food Manage</a></li>
                    <li><a href="../Admin/order-admin.php">Order Manage</a></li>
                    <li><a href="../Public/chef-show.php">Chef Manage</a></li>
                    <li><a href="../Admin/customer-manage.php">Customer Manage</a></li>

                    <?php
                }else {
                    ?>
                    <li><a href="../Public/chef-show.php">Chefs</a></li>
                    <li><a href="../Customer/food-menu-order.php">Order</a></li>
                    <?php if(isset($_SESSION['type'])&&!strcmp($_SESSION['type'],'customer')){?>
                        <li><a href="../Customer/order-customer.php">Order List</a></li>
                    <?php }?>
                <?php }?>

                <li><a href="../Public/about.php">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!isset($_SESSION['username'])){?>
                    <li><a href="../Public/registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="../Public/login.php"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>
                <?php }else{?>

                    <?php if(isset($_SESSION['type'])&&!strcmp($_SESSION['type'],'admin')){?>
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span><span style="color: #00CC00;"><?= $_SESSION['username']?></span></a></li>
                    <?php }else{?>
                        <li><a href="../Customer/user-page.php"><span class="glyphicon glyphicon-user"></span><span style="color: #00CC00;"><?= $_SESSION['username']?></span></a></li>
                    <?php }?>

                    <li><a href="../Security/logout.php"><span class="glyphicon glyphicon-log-out"></span> Signout</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">

<!--    carousel starts-->
    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="">

                <div class="item active">
                    <img src="../images/intro-bg.jpg" alt="Los Angeles" style="width:100%;height: 350px;">
                    <div class="carousel-caption">
                        <h3>Our  Decoration</h3>
                        <p>This confirms your delightness.</p>
                    </div>
                </div>

                <div class="item">
                    <img src="../images/gallery-bg.jpg" alt="Chicago" style="width:100%;height: 350px;">
                    <div class="carousel-caption">
                        <h3>Our Gorgeous furnisher</h3>
                        <p>This confirms your 100% comfort.</p>
                    </div>
                </div>

                <div class="item">
                    <img src="../images/burger.jpg" alt="New York" style="width:100%;height: 350px;">
                    <div class="carousel-caption">
                        <h3>Yammy Burger</h3>
                        <p>You must love her</p>
                    </div>
                </div>
                <div class="item">
                    <img src="../images/pizza.jpg" alt="New York" style="width:100%;height: 350px;">
                    <div class="carousel-caption">
                        <h3>Delicious Pizza</h3>
                        <p>This 100% satisfies your taste.</p>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

<!--    carousel ends-->


    <div class="content-body container" style="margin-left: 7%;">

        <!--Welcome Part Start-->
        <div class="row">

            <!--Welcome Start-->
            <div class="col-md-6 col-lg-7 welcome">
                <h1 style="color: #9C27B0">Welcome to WE HUNGRY</h1>
                <p>
                    <img src="../images/restaurant.jpg" class="img col-sm-6 col-xs-8 img-responsive img-circle pull-left">
                    In 2001, <strong>WE HUNGRY RESTAURANT</strong> of Feni started its all food serving
            activities with only some small area for only in place service. Since then, around 6 years it ie serving
            standanrd BSTI certified foods.From 2003 it has started serving online order which has a great
            reputation .It not only serve foods in Feni but also outside of Feni . Outside of Feni many
            people comes for the <strong>WE HUNGRY</strong> test.The price of foods is also resonable here.
            We serve <span style="color: #E91E63">Pizza,Burger,Grill,BBQ,Chiken Fry, Fried Rice etc etc.</span>
            If you are a crazzy lover of food then as a friend i suggest you to check the <strong>WE HUNGRY</strong>
            test.
            </p>
        </div>
        <!--Welcome End-->

<!--            Tab system starts-->
            <div class="col-md-5 col-lg-4 col-xs-11">
                <br>
                <ul class="nav nav-tabs nav-justified" style="background-color: #E3E3E3">
                    <li class="active">
                        <a data-toggle="tab" href="#breakfast">Breakfast</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#lunch">Lunch</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#snacks">Snacks</a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#dinner">Dinner</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!--Breakfast Start-->
                    <div id="breakfast" class="tab-pane fade in active">
                        <ul class="list-group">

                            <?php foreach ($breakfast as $item){?>
                            <li class="list-group-item row">
                                <img src="<?= $item['foodimage']?>" alt="" class="img img-responsive col-xs-3 img-thumbnail">
                                <a href="food-item?id="<?= $item['id']?> class="col-xs-9">
                                    <?= $item['name']?>
                                </a>
                            </li>
                            <?php } ?>


                            <li class="list-group-item row">
                                <a href="food-menu-public.php" class="btn btn-primary btn-lg pull-right">
                                    See all foods
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!--Breakfast End-->

                    <!--Launch Start-->
                    <div id="lunch" class="tab-pane fade">
                        <ul class="list-group">
                            <?php foreach ($lunch as $item){?>
                                <li class="list-group-item row">
                                    <img src="<?= $item['foodimage']?>" alt="" class="img img-responsive col-xs-3 img-thumbnail">
                                    <a href="food-item?id="<?= $item['id']?> class="col-xs-9">
                                        <?= $item['name']?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="list-group-item row">
                                <a href="food-menu-public.php" class="btn btn-primary btn-lg pull-right">
                                    See all foods
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!--Launch End-->

                    <!--Snacks Start-->
                    <div id="snacks" class="tab-pane fade">
                        <ul class="list-group">
                            <?php foreach ($snack as $item){?>
                                <li class="list-group-item row">
                                    <img src="<?= $item['foodimage']?>" alt="" class="img img-responsive col-xs-3 img-thumbnail">
                                    <a href="food-item?id="<?= $item['id']?> class="col-xs-9">
                                        <?= $item['name']?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="list-group-item row">
                                <a href="food-menu-public.php" class="btn btn-primary btn-lg pull-right">
                                    See all foods
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!--Snack End-->

                    <!--Dinner Start-->
                    <div id="dinner" class="tab-pane fade">
                        <ul class="list-group">
                            <?php foreach ($dinner as $item){?>
                                <li class="list-group-item row">
                                    <img src="<?= $item['foodimage']?>" alt="" class="img img-responsive col-xs-3 img-thumbnail">
                                    <a href="food-item?id="<?= $item['id']?> class="col-xs-9">
                                        <?= $item['name']?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="list-group-item row">
                                <a href="food-menu-public.php" class="btn btn-primary btn-lg pull-right">
                                    See all foods
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!--Dinner End-->

                </div>
            </div>
<!--            Tab system ends-->

        </div>
        <!--Welcome Part End-->

    </div>
<!--    content ends-->
</div>


<!--<div class="footer">This is footer</div>-->
<div id="footer" style="background-color: #262626">
    <div class="container text-center">
        <div class="col-md-4">
            <h3 class="item-head" style="color: #81A63B">Address</h3>
            <div class="contact-item">
                <p>Trunk Road,</p>
                <p>Feni, Bangladesh</p>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="item-head" style="color: #81A63B">Opening Hours</h3>
            <div class="contact-item">
                <p>Sun-Thurs: 10:00 AM - 11:00 PM</p>
                <p>Fri-Sat: 11:00 AM - 02:00 AM</p>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="item-head" style="color: #81A63B">Contact Info</h3>
            <div class="contact-item" >
                <p>Phone: 01800000000</p>
                <p>Email: we.hungry@gmail.com</p>
            </div>
        </div>
    </div>

</div>
</body>
</html>

