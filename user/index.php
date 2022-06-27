<?php
session_start();
include "../admin/mysqlconnection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akkad Bookstore Inventory Management System</title>
    <link rel="stylesheet" href="css/index.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="loginbox">
    <form autocomplete='off' class='form' name="form1" action="" method="post">
        <div class='control'>
            <center>
            <h1>
            User Login
            </h1>
            </center>
        </div>
        <div class='control block-cube block-input'>
            <input name='username' placeholder='Username' type='text' required>
            <div class='bg-top'>
            <div class='bg-inner'></div>
            </div>
            <div class='bg-right'>
            <div class='bg-inner'></div>
            </div>
            <div class='bg'>
            <div class='bg-inner'></div>
            </div>
        </div>
        <div class='control block-cube block-input'>
            <input name='password' placeholder='Password' type='password' required>
            <div class='bg-top'>
            <div class='bg-inner'></div>
            </div>
            <div class='bg-right'>
            <div class='bg-inner'></div>
            </div>
            <div class='bg'>
            <div class='bg-inner'></div>
            </div>
        </div>
        <div class="form-actions">
            <button class='btn block-cube block-cube-hover' type='submit' name="submit1" value="Login" class="btn btn-success">
                <div class='bg-top'>
                <div class='bg-inner'></div>
                </div>
                <div class='bg-right'>
                <div class='bg-inner'></div>
                </div>
                <div class='bg'>
                <div class='bg-inner'></div>
                </div>
                <div class='text'>
                Log In
                </div>
            </button>
        </div>
    </form>

    <?php
    if(isset($_POST["submit1"])){
        $username=mysqli_real_escape_string($link, $_POST["username"]);
        $password=mysqli_real_escape_string($link, $_POST["password"]);
        $count=0;
        $res=mysqli_query($link, "select * from user_details where 
        username='$username' && password='$password' && accessLevel='User' && status='Active'");
        $count=mysqli_num_rows($res);
        if($count>0){
            $_SESSION["user"]=$username;
            ?>
            <script type="text/javascript">
            window.location="dashboard.php";
            </script>
            <?php
        }
        else{
            ?>
                <center>
                Invalid username and/or password, or blocked by admin.
                </center>
            <?php
        }
    }
    ?>
</div>

</body>
</html>
