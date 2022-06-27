<?php
include "../../admin/mysqlconnection.php";
$vendorName=$_GET["vendorName"];
$bookName=$_GET["bookName"];
$res=mysqli_query($link, "select * from book_details where vendorName='$vendorName' && bookName='$bookName'");
?>
<select class="span11" name="authorName" id="authorName" required>
    <option></option>
<?php

while($row=mysqli_fetch_array($res)){
    print "<option>";
    print $row["authorName"];
    print "</option>";
}
print "</select>";
?> 