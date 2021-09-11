<?php
require_once '../Security/redirectToIfNotAdmin.php';
include_once '../layout/header.php';
require_once '../src/database.php';
$sql="SELECT type_name FROM type;";
$types=db_select($sql);

?>


    <style>
        .round_btn:hover {
            color: #F2A13E;
        }

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
    <script>

    </script>

    <form action="food-menu-admin.php" id="form1" method="POST" enctype="multipart/form-data">

        <h1>New Food Entry Form</h1>


        <div class="box-input">
            <!--User Name-->
            <h3>Name*</h3>
            <div class="form-group">
                <textarea class="form-control" style="font-size: large" rows="1" cols="" name="name" id="name"
                          required></textarea>
                <p id="userPara"></p>
            </div>
            <!--Add Image-->
            <h3>Add Image</h3>
            <input type="file" name="image" >

            <!--Ingredients-->
            <h3>Ingredients*</h3>
            <div class="form-group">
                <textarea class="form-control" style="font-size: large" rows="1" cols="" name="ing" id="ing"
                          required></textarea>
                <p id="userPara"></p>
            </div>

            <!--Type-->
            <h3>Type*</h3>
            <div class="form-group">
                <select class="form-control" title="Type" style="width: 100%;" name="type" id="">
                    <?php foreach ( $types as $type) { ?>
                        <option>
                            <?=ucfirst( $type['type_name']);?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!--Price-->
            <h3>Price*</h3>
            <div class="form-group">
                <input type="number" class="form-control" style="font-size: large" rows="1" cols="" name="price" id="price" required >
                <p id="userPara"></p>
            </div>

        </div>
        <h4>
            <input class="btn btn-success btn-lg" type="submit" id="addFood" name="add" value="Add">
            <input type="button" name="cancel" value="Cancel" class="btn btn-default btn-lg">
        </h4>

    </form>

<?php include_once '../layout/footer.php' ?>