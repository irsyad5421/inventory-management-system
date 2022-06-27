<?php
include "../../admin/mysqlconnection.php";
$bookName=$_GET["bookName"];
$authorName=$_GET["authorName"];
$res=mysqli_query($link, "select * from book_current_stock where bookName='$bookName' && authorName='$authorName'");
while($row=mysqli_fetch_array($res)){
    print $row["retailPrice"];
}
?>