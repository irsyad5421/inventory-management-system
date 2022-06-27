<?php
session_start();
?>

<?php
    $quantitySession=0;
    $max=0;
    $amountBill=0;
    if(isset($_SESSION['cart'])){
        $max=sizeof($_SESSION['cart']);
    }

    for($i=0;$i<$max;$i++){
        $retailPriceSession="";
        if(isset($_SESSION['cart'][$i])){
            foreach($_SESSION['cart'][$i] as $key=> $val){
                if($key=="quantity"){
                    $quantitySession=$val;
                }
                elseif($key=="retailPrice"){
                    $retailPriceSession=$val;
                }
            }
            $amountBill=$amountBill+((int)$quantitySession*(int)$retailPriceSession);
        }
    }
print $amountBill;
?>