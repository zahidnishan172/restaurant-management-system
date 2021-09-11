<?php
include_once '../layout/header.php';
require_once '../src/database.php';

$foodId=$_GET['foodId'];
if(isset($_POST['post']))
{
    $comment=$_POST['comment'];
    $query="INSERT INTO `feedback` (`id`, `comment`, `customerid`, `foodid`, `date`) select 'NULL', '".$comment."', id, '".$foodId."', '".date("Y-m-d")."' from customer where username='".$_SESSION['username']."';";

    db_insert($query);
    $address = "Location: refresh.php?address=".$_SERVER['PHP_SELF'];
    header($address.'?foodId='.$foodId);

}

$query="select name,ingredients,price,foodimage from foodmenu WHERE id='".$foodId."'";
$foods=db_select($query);
$query="select feedback.id,comment,customer.fullname,date from feedback,customer where foodid='".$foodId."' and feedback.customerid=customer.id";
$output=db_select($query);


if(session_status()==PHP_SESSION_NONE){
    session_start();
}



?>

<style>


    img {
        display: block;
        margin: auto;
        width: 40%;
    }
    body
    {
        text-align:center;
        font-family:helvetica;
        background-color:#A9D0F5;
    }
    h1
    {
        color:blue;
        text-align:center;
        margin-top:10px;
    }
    textarea
    {
        width:500px;
        height:100px;
        border:1px solid silver;
        border-radius:5px;
        font-size:17px;
        padding:10px;
        font-family:helvetica;
    }
    .comment_div
    {
        width:500px;
        background-color:white;
        margin-top:10px;
        text-align:left;
    }
    .comment_div .name
    {
        font-style:italic;
        padding:10px;
        background-color:grey;
        color:white;
        text-align:left;
    }
    .comment_div .comment
    {
        padding:10px;

    }
    .comment_div .time
    {
        font-style:italic;
        padding:10px;
        background-color:grey;
        color:white;
        text-align:left;
    }
    a{
        cursor: pointer;
    }

</style>
<script>
    function deleteFood(foodId,deleteComntId){
        if(confirm('sure to delete the comment')){
            $.post('../Security/jquery-process.php',{deleteComntId:deleteComntId},function(data){
                window.location.href = 'food-review.php?foodId='+foodId;
            });

        }
    }
</script>

<div class="">

    <form action="food-review.php?foodId=<?= $foodId ?>" id="form1" method="POST" enctype="multipart/form-data">

       <div class="col-md-offset-1">
           <img src="<?=$foods[0]['foodimage']?>" class="img-responsive" >
           <h1>Name: <?= $foods[0]['name']?></h1>
           <h2>Ingredients: <?= $foods[0]['ingredients']?></h2>
           <h3 style=" color:#009486;">Price: <?= $foods[0]['price']?> Tk</h3>

           <?php foreach ($output as $item):?>
               <div class="col-md-offset-3">
                   <div class="comment_div">
                       <p class="name">
                           <span> Posted By: <?php echo $item['fullname'];?></span>

                           <?php if(isset($_SESSION['username'])&& !strcmp($_SESSION['type'],'admin')){?>
                           <a onclick="deleteFood('<?= $foodId?>',<?= $item['id']?>)" class="pull-right" title="Delete">
                               <span class="glyphicon glyphicon-remove" style="color: brown"></span>
                           </a>
                           <?php } ?>

                       </p>
                       <p class="comment"><?php echo $item['comment'];?></p>
                       <p class="time">Date: <?php echo  $item['date']?></p>
                   </div>
               </div>
           <?php endforeach; ?>
           <?php if(!isset($_SESSION['username'])){?>
               <span style="color: #1B6D85">Please <a style="color: red" href="../Public/registration.php">Register</a> and <a style="color: green" href="../Public/login.php">Log in</a> to comment .</span>
           <?php }?>
       </div>

        <?php if(isset($_SESSION['username'])&&!strcmp($_SESSION['type'],'customer')){?>
            <div style="margin-left: 7%">
                <textarea id="comment" name="comment" placeholder="Write Your Comment Here....." required></textarea>
                <br>
                <input type="submit" name="post" value="Post Comment" class="btn btn-success">
            </div>
        <?php }?>

    </form>
</div>

<?php
include_once '../layout/footer.php';
?>
