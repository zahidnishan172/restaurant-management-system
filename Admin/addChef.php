<?php
include_once '../layout/header.php';
include_once '../src/database.php';


if (isset($_POST['add'])) {
    if ($_FILES['image']) {
        $target_dir = "../images/";
        $target_file = $target_dir.basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "done";
        }

    }
    $image_up = $target_file ;
    $query = "INSERT INTO chef VALUES ('','$_POST[name]','$image_up','$_POST[qualification]')";
    db_insert($query);

}

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

    <form action="../Public/chef-show.php" id="form1" method="POST" enctype="multipart/form-data">

        <h1>New Chef Entry Form</h1>


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
            <h3>Qualification*</h3>
            <div class="form-group">
                <textarea class="form-control" style="font-size: large" rows="1" cols="" name="qualification" id="qualification"
                          required></textarea>
                <p id="userPara"></p>
            </div>

        </div>
        <h4>
            <input class="btn btn-success btn-lg" type="submit" id="addChef" name="add" value="Add">
            <input type="button" name="cancel" value="Cancel" class="btn btn-default btn-lg">
        </h4>

    </form>

<?php include_once '../layout/footer.php' ?>