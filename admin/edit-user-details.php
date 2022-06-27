<?php
session_start();
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
?>

<?php
include "header.php";
include "mysqlconnection.php";
$id=$_GET["id"];
$firstName="";
$lastName="";
$username="";
$password="";
$accessLevel="";
$status="";
$res=mysqli_query($link, "select * from user_details where id=$id");
while($row=mysqli_fetch_array($res)){
    $firstName=$row["firstName"];
    $lastName=$row["lastName"];
    $username=$row["username"];
    $password=$row["password"];
    $accessLevel=$row["accessLevel"];
    $status=$row["status"];
}
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="user-details.php" class="tip-bottom"><i class="icon-user"></i><b>IMS User Details</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Edit User Registration</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">First Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="firstName" required value="<?php print $firstName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="lastName" required value="<?php print $lastName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Username :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="username" readonly value="<?php print $username; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">New Password :</label>
                                <div class="controls">
                                    <input type="password"  class="span11" name="password" required value="<?php print $password; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Access Level :</label>
                                <div class="controls">
                                    <select name="accessLevel" class="span11">
                                        <option <?php if($accessLevel=="User"){print "selected";} ?>>User</option>
                                        <option <?php if($accessLevel=="Admin"){print "selected";} ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status :</label>
                                <div class="controls">
                                    <select name="status" class="span11">
                                        <option <?php if($status=="Active"){print "selected";} ?>>Active</option>
                                        <option <?php if($status=="Inactive"){print "selected";} ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Update</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                Record updated successfully.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST["submit1"])){
    mysqli_query($link, "update user_details set 
    firstName='$_POST[firstName]', lastName='$_POST[lastName]', password='$_POST[password]', 
    accessLevel='$_POST[accessLevel]', status='$_POST[status]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
            document.getElementById("success").style.display="block";
            setTimeout(function(){
                window.location="user-details.php";
            }, 1000);
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
