

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .contact-item{
            color: #F4F4F4;
        }

    </style>
</head>
<body>
<!--navbar-fixed-top on-->
<nav class="navbar navbar-inverse ">
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

                <li><a href="../Security/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="margin-bottom: 100px;min-height: 58vh">


