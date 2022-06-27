<?php
include "../../admin/mysqlconnection.php";
$vendorName=$_GET["vendorName"];
$res=mysqli_query($link, "select * from book_details where vendorName='$vendorName'");
?>
<select class="span11" name="bookName" id="bookName" onchange="selectBookName(this.value, '<?php print $vendorName ?>')" required>
    <option></option>
<?php

while($row=mysqli_fetch_array($res)){
    print "<option>";
    print $row["bookName"];
    print "</option>";
}
print "</select>";
?> 