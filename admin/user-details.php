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
                        <h5>New User Registration</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">First Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="firstName" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="lastName" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Username :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="username" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">New Password :</label>
                                <div class="controls">
                                    <input type="password"  class="span11" name="password" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Access Level :</label>
                                <div class="controls">
                                    <select name="accessLevel" class="span11" required>
                                        <option></option>
                                        <option>User</option>
                                        <option>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Save</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                Record saved successfully.
                            </div>
                            <div class="alert alert-danger" id="error" style="display:none">
                                Username already exist.
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>User List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Access Level</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res=mysqli_query($link, "select * from user_details");
                                while($row=mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td><?php print $row["firstName"]; ?></td>
                                        <td><?php print $row["lastName"]; ?></td>
                                        <td><?php print $row["username"]; ?></td>
                                        <td><?php print $row["accessLevel"]; ?></td>
                                        <td><?php print $row["status"]; ?></td>
                                        <td><a href="edit-user-details.php?id=<?php print $row["id"]; ?>" style="color:blue">Edit</a></td>
                                        <td><a href="delete-user.php?id=<?php print $row["id"]; ?>" style="color:red">Delete</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST["submit1"])){
    $count=0;
    $res=mysqli_query($link, "select * from user_details where username='$_POST[username]'");
    $count=mysqli_num_rows($res);
    if($count>0){
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display="block";
            document.getElementById("success").style.display="none";
        </script>
        <?php
    }
    else{
        $res=mysqli_query($link, "insert into user_details 
        values(NULL, '$_POST[firstName]', '$_POST[lastName]', '$_POST[username]', '$_POST[password]', '$_POST[accessLevel]', 'Active')") 
        or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display="block";
            document.getElementById("error").style.display="none";
            setTimeout(function(){
                window.location.href=window.location.href;
            }, 1000);
        </script>
        <?php
    }
}
?>

<?php
include "footer.php";
?>
