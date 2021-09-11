<?php
include_once '../layout/header.php';
require_once '../src/database.php';

$id=$_GET['id'];
$query="select name,qualification  from chef WHERE id='$id'";
$res=db_select($query);

//$name=$foods['name'];

?>

<style>
    .box-input {
        background-color: #f1f1f1;
        padding: 0.01em 16px;
        margin: 20px 0;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
    }
    .box-input h3 {
        color: green;
    }
</style>
<div class="box-input">

    <form action="../Public/chef-show.php?id=<?=$id ?>" id="form1" method="POST" enctype="multipart/form-data">

        <h1>Update Chef List</h1>
        <input type="hidden" name="category" value="update">

        <!--Name-->
        <h3>Name*</h3>
        <div class="form-group ">
            <h4>
                <input name="name" type="text" title="name" required
                       value="<?php echo ucfirst($res[0]['name']); ?>"
                       class=" form-control post-input"/>
            </h4>

        </div>
        <!--Image Upload-->
        <h3>Image*</h3>
        <div class=" form-group ">
            <input  type="file" class=" imgid" name="image" id="image">

        </div>
        <!--Qualification-->
        <h3>Qualification*</h3>
        <div class="form-group ">
            <h4>
                <input  class=" form-control post-input"name="qualification" type="text" title="qualification" required
                       value="<?php echo ucfirst($res[0]['qualification']); ?>"
                      />
            </h4>

        </div>





        <div class=""> <h4>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <input type="reset" name="cancel" value="Cancel" class="btn btn-primary">
            </h4></div>
    </form>
</div>

<?php
include_once '../layout/footer.php';
?>
