<?php
 include_once '../layout/header.php';
require_once '../src/database.php';




if (isset($_POST['reg'])) {
    $query = "INSERT INTO customer VALUES ('','$_POST[fullname]','$_POST[username]','$_POST[password]','$_POST[address]','$_POST[contact]')";
    db_insert($query);
    header('Location: ../Public/index.php');

}
?>
    <script>

        $(document).ready(function(){
            $("form").submit(function(e){
                var pass = $('#password').val();
                var conPass = $('#password_confirm').val();
                if(pass!=conPass){
                    e.preventDefault(e);
                    $('#confirmText').text("Password doesn't match");
                }

            });
        })
        function passwordCheck() {
            var pass = $('#password').val();
            var conFirm = $('#password_confirm').val();
            var error = $('#confirmText');

            if (pass != conFirm && pass!="" && confirm!="") {
                error.text("Password doesn't match");
            } else {
                error.text("");
            }


        }
    </script>

    <style>
        .box-input {
            background-color: #f1f1f1;
            padding: 0.01em 16px;
            margin: 20px 0;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
        }
        .form-input{
                width: 40%;
                margin-left: 30%;
                margin-top: 0px;
        }
    </style>
                <form class=" box-input form-input" action="registration.php" method="POST">
                    <div id="legend">
                        <legend class="" style="margin-top: 12px">Register</legend>
                    </div>

                        <div class="form-group">
                            <label for="fullname">Full Name :</label>
                            <input name="fullname" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="username">Username :</label>
                            <input type="text" id="username" name="username" placeholder=""
                                   class="form-control" required>
                        </div>




                        <div class="form-group">
                            <label class="control-label" for="password">Password :</label>
                            <input type="password" id="password" name="password" placeholder=""
                                   class="form-control" required>
                        </div>




                        <div class="form-group">
                            <label class="control-label" for="password_confirm">Password (Confirm) :</label>
                            <input type="password" id="password_confirm" name="password_confirm" placeholder=""
                                   class="form-control" required onchange="passwordCheck()"><span><p
                                        id="confirmText" style="color: red"></p></span>
                        </div>




                        <div class=" form-group">
                            <label class="control-label" for="address">Address :</label>
                            <textarea id="address" name="address" placeholder="" class="form-control input-lg" required></textarea>
                        </div>




                        <div class=" form-group">
                            <label class="control-label" for="contact">Contact :</label>
                            <input type="number" id="contact"  name="contact" placeholder="Mobile Number" class="form-control"
                                   required>
                        </div>



                    <div>
                        <!-- Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="margin-left: 25%"  name="reg">Register</button>
                            <button class="btn btn-primary" style="margin-left: 5%">Cancel</button>
                        </div>
                    </div>

                </form>

<?php include_once '../layout/footer.php'; ?>