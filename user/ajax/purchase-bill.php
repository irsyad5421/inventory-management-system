<?php
session_start();
?>
<table class="table table-bordered">
     <tr>
        <th>Book Name</th>
        <th>Author Name</th>
        <th>Retail Price/Copy</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th></th>
    </tr>
<?php
    $duplicateQuantity=0;
    $quantitySession=0;
    $max=0;
    if(isset($_SESSION['cart'])){
        $max=sizeof($_SESSION['cart']);
    }

    for($i=0;$i<$max;$i++){
        $bookNameSession="";
        $authorNameSession="";
        $retailPriceSession="";
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
                elseif($key=="retailPrice"){
                    $retailPriceSession=$val;
                }
            }
            if($bookNameSession!=""){
                ?>
                <tr>
                    <td><?php print $bookNameSession; ?></td>
                    <td><?php print $authorNameSession; ?></td>
                    <td>$<?php print $retailPriceSession; ?></td>
                    <td><?php print $quantitySession; ?></td>
                    <td>$<?php print ($retailPriceSession*$quantitySession); ?></td>
                    <td style="color:red; cursor:pointer" onclick="deleteQty('<?php print $i ?>')">Delete</td>
                </tr>
                <?php
            }
        }
    }
?>
</table>