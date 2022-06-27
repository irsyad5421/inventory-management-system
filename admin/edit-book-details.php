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
$bookName="";
$authorName="";
$bookType="";
$bookGenre="";
$vendorName="";
$res=mysqli_query($link, "select * from book_details where id=$id");
while($row=mysqli_fetch_array($res)){
    $bookName=$row["bookName"];
    $authorName=$row["authorName"];
    $bookType=$row["bookType"];
    $bookGenre=$row["bookGenre"];
    $vendorName=$row["vendorName"];
}
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="book-details.php" class="tip-bottom"><i class="icon-book"></i><b>Product Details</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Edit Book Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Book Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="bookName" required value="<?php print $bookName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Author Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="authorName" required value="<?php print $authorName; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Type :</label>
                                <div class="controls">
                                    <select name="bookType" class="span11">
                                        <option <?php if($bookType=="Fiction"){print "selected";} ?>>Fiction</option>
                                        <option <?php if($bookType=="Non-fiction"){print "selected";} ?>>Non-fiction</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Genre :</label>
                                <div class="controls">
                                    <select name="bookGenre" class="span11">
                                        <option <?php if($bookGenre=="Action & Adventure"){print "selected";} ?>>Action & Adventure</option>
                                        <option <?php if($bookGenre=="Classic"){print "selected";} ?>>Classic</option>
                                        <option <?php if($bookGenre=="Comic & Graphic Novel"){print "selected";} ?>>Comic & Graphic Novel</option>
                                        <option <?php if($bookGenre=="Drama"){print "selected";} ?>>Drama</option>
                                        <option <?php if($bookGenre=="Fantasy"){print "selected";} ?>>Fantasy</option>
                                        <option <?php if($bookGenre=="Historical Fiction"){print "selected";} ?>>Historical Fiction</option>
                                        <option <?php if($bookGenre=="Horror"){print "selected";} ?>>Horror</option>
                                        <option <?php if($bookGenre=="Mystery"){print "selected";} ?>>Mystery</option>
                                        <option <?php if($bookGenre=="Romance"){print "selected";} ?>>Romance</option>
                                        <option <?php if($bookGenre=="Sci-Fi"){print "selected";} ?>>Sci-Fi</option>
                                        <option <?php if($bookGenre=="Thriller & Suspense"){print "selected";} ?>>Thriller & Suspense</option>
                                        <option <?php if($bookGenre=="Autobiography & Biography"){print "selected";} ?>>Autobiography & Biography</option>
                                        <option <?php if($bookGenre=="Art & Architecture"){print "selected";} ?>>Art & Architecture</option>
                                        <option <?php if($bookGenre=="Business & Economics"){print "selected";} ?>>Business & Economics</option>
                                        <option <?php if($bookGenre=="Encyclopedia"){print "selected";} ?>>Encyclopedia</option>
                                        <option <?php if($bookGenre=="Food & Drink"){print "selected";} ?>>Food & Drink</option>
                                        <option <?php if($bookGenre=="Health & Fitness"){print "selected";} ?>>Health & Fitness</option>
                                        <option <?php if($bookGenre=="History"){print "selected";} ?>>History</option>
                                        <option <?php if($bookGenre=="Math"){print "selected";} ?>>Math</option>
                                        <option <?php if($bookGenre=="Science & Technology"){print "selected";} ?>>Science & Technology</option>
                                        <option <?php if($bookGenre=="Social Science"){print "selected";} ?>>Social Science</option>
                                        <option <?php if($bookGenre=="Sports & Leisure"){print "selected";} ?>>Sports & Leisure</option>
                                        <option <?php if($bookGenre=="Travel"){print "selected";} ?>>Travel</option>
                                        <option <?php if($bookGenre=="True Crime"){print "selected";} ?>>True Crime</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vendor Name :</label>
                                <div class="controls">
                                    <select name="vendorName" class="span11" required>
                                        <?php
                                        $res=mysqli_query($link, "select * from vendor_details");
                                        while($row=mysqli_fetch_array($res)){
                                            ?>
                                            <option <?php if($row["vendorName"]==$vendorName){print "selected";} ?>>
                                            <?php
                                            print $row["vendorName"];
                                            print "</option>";
                                        }
                                        ?>
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
    mysqli_query($link, "update book_details set 
    bookName='$_POST[bookName]', authorName='$_POST[authorName]', bookType='$_POST[bookType]', 
    bookGenre='$_POST[bookGenre]', vendorName='$_POST[vendorName]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
            document.getElementById("success").style.display="block";
            setTimeout(function(){
                window.location="book-details.php";
            }, 1000);
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>
