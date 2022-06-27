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
        <div id="breadcrumb"><a href="vendor-details.php" class="tip-bottom"><i class="icon-group"></i><b>Vendor Details</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>New Vendor</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Vendor Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="vendorName" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
                                    <textarea class="span11" name="address" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">City :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="city" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Postcode :</label>
                                <div class="controls">
                                    <input type="text"  class="span11" name="postcode" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact Number :</label>
                                <div class="controls">
                                    <input type="text"  class="span11" name="contactNumber" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email :</label>
                                <div class="controls">
                                    <input type="text"  class="span11" name="email" required/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Save</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                Record saved successfully.
                            </div>
                            <div class="alert alert-danger" id="error" style="display:none">
                                Vendor already exist.
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Vendor List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Postcode</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res=mysqli_query($link, "select * from vendor_details");
                                while($row=mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td><?php print $row["vendorName"]; ?></td>
                                        <td><?php print $row["address"]; ?></td>
                                        <td><?php print $row["city"]; ?></td>
                                        <td><?php print $row["postcode"]; ?></td>
                                        <td><?php print $row["contactNumber"]; ?></td>
                                        <td><?php print $row["email"]; ?></td>
                                        <td><a href="edit-vendor-details.php?id=<?php print $row["id"]; ?>" style="color:blue">Edit</a></td>
                                        <td><a href="delete-vendor.php?id=<?php print $row["id"]; ?>" style="color:red">Delete</a></td>
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
    $res=mysqli_query($link, "select * from vendor_details where vendorName='$_POST[vendorName]'");
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
        $res=mysqli_query($link, "insert into vendor_details 
        values(NULL, '$_POST[vendorName]', '$_POST[address]', '$_POST[city]', '$_POST[postcode]', '$_POST[contactNumber]', '$_POST[email]')") 
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
