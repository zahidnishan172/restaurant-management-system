<?php
include "../layout/header.php";
require_once "../src/database.php";
$id=$_GET['id'];
$sql="select qualification,image from chef WHERE id='$id'";
$res=db_select($sql);
?>


<style media="screen">
    .img-responsive {
        width: auto;
        height: 400px;
    }

    .tile {
        height: 550px;
        min-width:250px;
        margin-top:20px;
    }

    .tile > a > div {
        box-shadow: 0 0 5px 1px gray;
        padding:2px;
    }
    .tile > a > div:hover {
        box-shadow: 0 0 5px 3px gray;
    }

    .tile > a:hover{
        text-decoration: none;
    }

    .tile img{
        display: block;
        margin: 0 auto;
    }
</style>



<div class="row">
    <h2>Chef Profile </h2>
    <hr>
        <div class="col-lg-4 col-md-6 col-sm-6 col-lg-offset-3 clearfix tile">

            <div>
                <div class="">
                    <img src="<?= $res[0]['image'] ?>" class="img-responsive" alt="" style="p " />
                </div>
                <div><h3>Qualification: <?= $res[0]['qualification'] ?></h3></div>

            </div>

        </div>
</div>
<?php include_once '../layout/footer.php' ?>


