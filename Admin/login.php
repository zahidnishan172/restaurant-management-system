<?php



include_once '../layout/header.php';
include_once '../src/database.php';


if (isset($_POST['log'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //echo $username.$password;
    $query = "SELECT username from admins WHERE username='$username' and password='$password';";
    $result = db_select($query);
    if ($result != null) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['username'] = $username;
        $_SESSION['type'] = "admin";
        header('location: ../Public/index.php');
//        $address = "Location: refresh.php?address=".$_SERVER['PHP_SELF'];
//        header($address);
        //echo "yes";
    } else {
        // echo "Error";
    }


}
?>

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

    <form class="box-input form-input" action="../Admin/login.php" method="POST">
        <div id="legend">
            <legend style="margin-top: 12px">Admin Login</legend>
        </div>

        <label class="control-label" for="username">Username</label>
        <div class="form-group">
            <input type="text" id="username" name="username" placeholder=""
                   class="form-control">
        </div>

        <label class="control-label" for="password">Password</label>
        <div class="form-group">
            <input type="password" id="password" name="password" placeholder=""
                   class="form-control">
        </div>
        <p><span style="color: red">Not yet registered?</span> <a href="../Public/registration.php" style="text-decoration: none;color: #00CC00"> Register now.</a></p>

        <!-- Button -->
        <div class="form-group">
            <button class="btn btn-primary" name="log">Login</button>
            <button class="btn btn-primary">Cancel</button>
        </div>

    </form>

<?php include_once '../layout/footer.php' ?>