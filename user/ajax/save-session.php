<?php
session_start();
include "../../admin/mysqlconnection.php";
$bookName=$_GET["bookName"];
$authorName=$_GET["authorName"];
$retailPrice=$_GET["retailPrice"];
$quantity=$_GET["quantity"];
$totalPrice=$_GET["totalPrice"];

if(isset($_SESSION['cart'])){
    $max=sizeof($_SESSION['cart']);
    $checkAvailable=0;
    $checkAvailable=checkDuplicate($bookName, $authorName);
    $availableQuantity=0;
    $checkDuplicateQuantity=0;
    if($checkAvailable==0){
        $availableQuantity=checkQuantity($bookName, $authorName, $link);
        if($availableQuantity>=$quantity){
            $b=array("bookName"=>$bookName, "authorName"=>$authorName, "retailPrice"=>$retailPrice, "quantity"=>$quantity);
            array_push($_SESSION['cart'], $b);
        }
        else{
            print "Invalid quantity.";
        }
    }
    else{
        $avQuantity=0;
        $existQuantity=0;
        $existQuantity=checkDuplicateQuantity($bookName, $authorName);
        $existQuantity=$existQuantity+$quantity;
        $avQuantity=checkQuantity($bookName, $authorName, $link);
        if($avQuantity>=$existQuantity){
            $checkBookNoSession=checkBookNoCookies($bookName, $authorName);
            $b=array("bookName"=>$bookName, "authorName"=>$authorName, "retailPrice"=>$retailPrice, "quantity"=>$existQuantity);
            $_SESSION['cart'][$checkBookNoSession]=$b;
        }
        else{
            print "Invalid quantity.";
        }
    }
}
else{
    $availableQuantity=checkQuantity($bookName, $authorName, $link);
    if($availableQuantity>=$quantity){
        $_SESSION['cart']=array(array("bookName"=>$bookName, "authorName"=>$authorName, "retailPrice"=>$retailPrice, "quantity"=>$quantity));
    }
    else{
        print "Invalid quantity.";
    }
}

function checkQuantity($bookName, $authorName, $link){
    $stockQuantity=0;
    $res=mysqli_query($link, "select * from book_current_stock where bookName='$bookName' && authorName='$authorName'");
    while($row=mysqli_fetch_array($res)){
        $stockQuantity=$row["stockQuantity"];  
    }
    return $stockQuantity;
}
function checkDuplicate($bookName, $authorName){
    $duplicate=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++){
        if(isset($_SESSION['cart'][$i])){
            $bookNameSession="";
            $authorNameSession="";
            foreach($_SESSION['cart'][$i] as $key=> $val){
                if($key=="bookName"){
                    $bookNameSession=$val;
                }
                elseif($key=="authorName"){
                    $authorNameSession=$val;
                }
            }
            if($bookNameSession==$bookName && $authorNameSession==$authorName){
                $duplicate=$duplicate+1;
            }
        }
    }
    return $duplicate;
}
function checkDuplicateQuantity($bookName, $authorName){
    $duplicateQuantity=0;
    $quantitySession=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++){
        $bookNameSession="";
        $authorNameSession="";
        if(isset($_SESSION['cart'][$i])){
            foreach($_SESSION['cart'][$i] as $key=> $val){
                if($key=="bookName"){
                    $bookNameSession=$val;
                }
                elseif($key=="authorName"){
                    $authorNameSession=$val;
                }
                elseif($key=="quantity"){
                    $quantitySession=$val;
                }
            }
            if($bookNameSession==$bookName && $authorNameSession==$authorName){
                $duplicateQuantity=$quantitySession;
            }
        }
    }
    return $duplicateQuantity;
}
function checkBookNoCookies($bookName, $authorName){
    $recordNo=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++){
        if(isset($_SESSION['cart'][$i])){
            $bookNameSession="";
            $authorNameSession="";
            foreach($_SESSION['cart'][$i] as $key=> $val){
                if($key=="bookName"){
                    $bookNameSession=$val;
                }
                elseif($key=="authorName"){
                    $authorNameSession=$val;
                }
            }
            if($bookNameSession==$bookName && $authorNameSession==$authorName){
                $recordNo=$i;
            }
        }
    }
    return $recordNo;
}
?>