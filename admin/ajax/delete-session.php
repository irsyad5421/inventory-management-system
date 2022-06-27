<?php
session_start();
$sessionid=$_GET["sessionid"];
$b=array("bookName"=>"", "authorName"=>"", "retailPrice"=>"", "quantity"=>"");
$_SESSION["cart"][$sessionid]=$b;
?>