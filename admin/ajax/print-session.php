<?php
session_start();
$max=0;
if(isset($_SESSION['cart'])){
    $max=sizeof($_SESSION['cart']);
}
for ($i = 0;$i < $max; $i++){
    if (isset($_SESSION['cart'][$i])){
        $bookName="";
        $authorName="";
        $quantity="";
        foreach($_SESSION['cart'][$i] as $key => $val){
            if($key=="bookName"){
                $bookName=$val;
            }elseif($key=="authorName"){
                $authorName=$val;
            } else if ($key=="quantity"){
                $quantity=$val;
            }
        }
        print $bookName." ".$authorName." ".$quantity;
        echo "<br>";
    }
}
?>
