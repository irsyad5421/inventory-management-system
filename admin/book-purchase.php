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
        <div id="breadcrumb"><a href="book-purchase.php" class="tip-bottom"><i class="icon-download-alt"></i><b>Product Purchase Order</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>New Book Purchase Order</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                        <div class="control-group">
                                <label class="control-label">Purchase Date :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="purchaseDate" value="<?php print date("Y-m-d") ?>" readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vendor :</label>
                                <div class="controls">
                                    <select name="vendorName" class="span11" id="vendorName" onchange="selectVendor(this.value)" required>
                                        <option></option>
                                        <?php
                                        $res=mysqli_query($link, "select * from vendor_details");
                                        while($row=mysqli_fetch_array($res)){
                                            print "<option>";
                                            print $row["vendorName"];
                                            print "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Name :</label>
                                <div class="controls" id="bookNameP">
                                    <select class="span11" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Author Name :</label>
                                <div class="controls" id="authorNameP">
                                    <select class="span11" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quantity :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="quantity" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Total Price :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="price" required/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Confirm Order</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                New order confirmed successfully.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function selectVendor(vendorName){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("bookNameP").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ajax/load-book-by-vendor.php?vendorName="+vendorName, true);
        xmlhttp.send();
    }
    function selectBookName(bookName, vendorName){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("authorNameP").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ajax/load-author-by-book.php?bookName="+bookName+"&vendorName="+vendorName, true);
        xmlhttp.send();
    }
</script>

<?php
if(isset($_POST["submit1"])){
    mysqli_query($link, "insert into book_purchase
    values(NULL, '$_POST[vendorName]', '$_POST[bookName]', '$_POST[authorName]', '$_POST[quantity]', '$_POST[price]', '$_POST[purchaseDate]', '$_SESSION[admin]')") 
    or die(mysqli_error($link));
    $count=0;
    $res=mysqli_query($link, "select * from book_current_stock where vendorName='$_POST[vendorName]' && bookName='$_POST[bookName]' && authorName='$_POST[authorName]'");
    $count=mysqli_num_rows($res);
    if($count==0){
        mysqli_query($link, "insert into book_current_stock values(NULL, '$_POST[vendorName]', '$_POST[bookName]', '$_POST[authorName]', '$_POST[quantity]', '0')") 
        or die(mysqli_error($link));
    }
    else{
        mysqli_query($link, "update book_current_stock set stockQuantity=stockQuantity+$_POST[quantity] where vendorName='$_POST[vendorName]' && bookName='$_POST[bookName]' && authorName='$_POST[authorName]'") 
        or die(mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
                window.location.href=window.location.href;
            }, 1000);
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
