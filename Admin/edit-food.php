<?php
include_once '../layout/header.php';
require_once '../src/database.php';
$sql="SELECT type_name FROM type;";
$types=db_select($sql);

$id=$_GET['id'];
$query="select name,ingredients,price,type from foodmenu WHERE id='$id'";
$foods=db_select($query);

//$name=$foods['name'];

?>

<style>

    .btn {
        border-radius: 20px;
        border: 2px solid;
        padding: 5px;
        background-color: #80000f;
        width: 10%;
        height: 5%;
        color: #e7e7e7;
    }
</style>
<div class="container">

    <form action="../Admin/food-menu-admin.php?id=<?=$id ?>" id="form1" method="POST" enctype="multipart/form-data">

        <h1>Update Food Item</h1>
        <input type="hidden" name="category" value="update">

        <!--Name-->
        <div class="form-group col-md-9">
            <label for="inputsm">Name* </label>

            <input   class="post-input form-control" type="text"  name="name"  required
                     value="<?php echo ucfirst($foods[0]['name']); ?>"
            />
        </div>


        <!--Ingredients-->
        <div class="form-group col-md-9">
            <label for="idDet" >Detail*</label>
            <textarea class=" post-input-text form-control " name="ing" title="ingredients" required
            ><?= ucfirst($foods[0]['ingredients']) ?></textarea>
        </div>

        <!--Type-->
        <div class="form-group col-md-9">
            <label for="idDet" >Type : <?=$foods[0]['type']?></label>
            <select  title="Type" class="form-control" name="type" id="">
                <?php foreach ( $types as $type) { ?>
                    <?php if(!strcmp($type['type_name'],$foods[0]['type'])){?>
                        <option value="<?= $type['type_name'];?>" selected><?=ucfirst( $type['type_name']);?></option>
                    <?php }else{?>
                        <option value="<?=$type['type_name'];?>"><?=ucfirst( $type['type_name']);?></option>
                    <?php }?>
                <?php } ?>
            </select>
        </div>

               <!--Price-->
        <div class="form-group col-md-9">
            <label for="inputsm">Price* </label>

            <input   class="post-input form-control" type="text"  name="price"  required
                     value="<?php echo ucfirst($foods[0]['price']); ?>"
            />
        </div>

        <!--Image Upload-->

        <div class=" form-group col-md-9">
            <label>Image*</label><br>
            <input  type="file" class=" imgid" name="image" id="image">

        </div>


        <div class="col-md-9"> <h4>
                <input class="btn" type="submit" name="update" value="Update">
                <input type="reset" name="cancel" value="Cancel" class="btn">
            </h4></div>
</div>
</form>
<?php
include_once '../layout/footer.php';
?>
