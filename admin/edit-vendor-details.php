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
$vendorName="";
$address="";
$city="";
$postcode="";
$contactNumber="";
$email="";
$res=mysqli_query($link, "select * from vendor_details where id=$id");
while($row=mysqli_fetch_array($res)){
    $vendorName=$row["vendorName"];
    $address=$row["address"];
    $city=$row["city"];
    $postcode=$row["postcode"];
    $contactNumber=$row["contactNumber"];
    $email=$row["email"];
}
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
                        <h5>Edit Vendor Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Vendor Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="vendorName" required value="<?php print $vendorName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
                                    <textarea class="span11" name="address" required><?php print $address; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">City :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="city" required value="<?php print $city; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Postcode :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="postcode" required value="<?php print $postcode; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact Number :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="contactNumber" required value="<?php print $contactNumber; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="email" required value="<?php print $email; ?>"/>
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
    mysqli_query($link, "update vendor_details set 
    vendorName='$_POST[vendorName]', address='$_POST[address]', city='$_POST[city]', 
    postcode='$_POST[postcode]', contactNumber='$_POST[contactNumber]', email='$_POST[email]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
            document.getElementById("success").style.display="block";
            setTimeout(function(){
                window.location="vendor-details.php";
            }, 1000);
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
