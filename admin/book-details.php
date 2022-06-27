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
        <div id="breadcrumb"><a href="book-details.php" class="tip-bottom"><i class="icon-book"></i><b>Product Details</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>New Book</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form name="form1" action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Book Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="bookName" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Author Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="authorName" required/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Type :</label>
                                <div class="controls">
                                    <select name="bookType" class="span11" required>
                                        <option></option>
                                        <option>Fiction</option>
                                        <option>Non-fiction</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Book Genre :</label>
                                <div class="controls">
                                    <select name="bookGenre" class="span11" required>
                                        <option></option>
                                        <option>Action & Adventure</option>
                                        <option>Classic</option>
                                        <option>Comic & Graphic Novel</option>
                                        <option>Drama</option>
                                        <option>Fantasy</option>
                                        <option>Historical Fiction</option>
                                        <option>Horror</option>
                                        <option>Mystery</option>
                                        <option>Romance</option>
                                        <option>Sci-Fi</option>
                                        <option>Thriller & Suspense</option>
                                        <option>Autobiography & Biography</option>
                                        <option>Art & Architecture</option>
                                        <option>Business & Economics</option>
                                        <option>Encyclopedia</option>
                                        <option>Food & Drink</option>
                                        <option>Health & Fitness</option>
                                        <option>History</option>
                                        <option>Math</option>
                                        <option>Science & Technology</option>
                                        <option>Social Science</option>
                                        <option>Sports & Leisure</option>
                                        <option>Travel</option>
                                        <option>True Crime</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Vendor :</label>
                                <div class="controls">
                                    <select name="vendorName" class="span11" required>
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
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Save</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                Record saved successfully.
                            </div>
                            <div class="alert alert-danger" id="error" style="display:none">
                                Book already exist.
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Book List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Book Name</th>
                                    <th>Author Name</th>
                                    <th>Book Type</th>
                                    <th>Book Genre</th>
                                    <th>Vendor Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res=mysqli_query($link, "select * from book_details");
                                while($row=mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td><?php print $row["bookName"]; ?></td>
                                        <td><?php print $row["authorName"]; ?></td>
                                        <td><?php print $row["bookType"]; ?></td>
                                        <td><?php print $row["bookGenre"]; ?></td>
                                        <td><?php print $row["vendorName"]; ?></td>
                                        <td><a href="edit-book-details.php?id=<?php print $row["id"]; ?>" style="color:blue">Edit</a></td>
                                        <td><a href="delete-book.php?id=<?php print $row["id"]; ?>" style="color:red">Delete</a></td>
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
    $res=mysqli_query($link, "select * from book_details where bookName='$_POST[bookName]' && authorName='$_POST[authorName]'");
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
        $res=mysqli_query($link, "insert into book_details 
        values(NULL, '$_POST[bookName]', '$_POST[authorName]', '$_POST[bookType]', '$_POST[bookGenre]', '$_POST[vendorName]')") 
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
