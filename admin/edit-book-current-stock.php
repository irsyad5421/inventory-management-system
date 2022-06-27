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
$bookName="";
$authorName="";
$stockQuantity="";
$retailPrice="";
$res=mysqli_query($link, "select * from book_current_stock where id=$id");
while($row=mysqli_fetch_array($res)){
    $vendorName=$row["vendorName"];
    $bookName=$row["bookName"];
    $authorName=$row["authorName"];
    $stockQuantity=$row["stockQuantity"];
    $retailPrice=$row["retailPrice"];
}
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="book-current-stock.php" class="tip-bottom"><i class="icon-hdd"></i><b>Current Inventory</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Edit Product(Book) Retail Price</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Vendor :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="vendorName" readonly value="<?php print $vendorName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="bookName" readonly value="<?php print $bookName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Author Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="authorName" readonly value="<?php print $authorName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Stock Quantity :</label>
                                <div class="controls">
                                    <input type="text"  class="span11" name="stockQuantity" readonly value="<?php print $stockQuantity; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Retail Price/Copy :</label>
                                <div class="controls">
                                    <input type="text"  class="span11" name="retailPrice" required value="<?php print $retailPrice; ?>"/>
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
    mysqli_query($link, "update book_current_stock set retailPrice='$_POST[retailPrice]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
            document.getElementById("success").style.display="block";
            setTimeout(function(){
                window.location="book-current-stock.php";
            }, 1000);
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
