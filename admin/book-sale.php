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
$billNo=0;
$res=mysqli_query($link, "select * from bill_header order by id desc limit 1");
while($row=mysqli_fetch_array($res)){
    $billNo=$row["id"];
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="content">
        <form name="form1" action="" method="post" class="form-horizontal nopadding">
            <div id="content-header">
                <div id="breadcrumb"><a href="book-sale.php" class="tip-bottom"><i class="icon-print"></i><b>Product Sales</b></a></div>
            </div>
            <div class="container-fluid">
                    <div class="row-fluid" style="background-color: white; min-height: 100px; padding:10px;">
                        <div class="span10">
                            <div class="widget-box">
                                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i></span>
                                    <h5>New Customer Bill</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="span2">
                                        <br>
                                        <div>
                                            <label>Bill No</label>
                                            <input type="text" class="span11" name="billNo" value="<?php print genBillNo($billNo) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <br>
                                        <div>
                                            <label>Purchase Date</label>
                                            <input type="text" class="span11" name="billDate" value="<?php print date("Y-m-d") ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid" style="background-color: white; min-height: 100px; padding:10px;">
                        <div class="span10">
                            <br>
                            <center><h4>Add Book Order</h4></center>
                            <div class="span3">
                                <div>
                                    <label>Book Name</label>
                                    <select class="span11" name="bookName" id="bookName" onchange="selectBookName(this.value)" required>
                                        <option></option>
                                        <?php
                                        $res = mysqli_query($link, "select * from book_current_stock");
                                        while ($row = mysqli_fetch_array($res)) {
                                            print "<option>";
                                            print $row["bookName"];
                                            print "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="span3">
                                <div>
                                    <label>Author Name</label>
                                    <div id="authorNameP">
                                        <select class="span11" required>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div>
                                    <label>Retail Price</label>
                                    <input type="text" class="span11" name="retailPrice" id="retailPrice" readonly value="0">
                                </div>
                            </div>
                            <div class="span1">
                                <div>
                                    <label>Quantity</label>
                                    <input type="text" class="span11" name="quantity" id="quantity" autocomplete="off" onkeyup="generateTotal(this.value)" required>
                                </div>
                            </div>
                            <div class="span2">
                                <div>
                                    <label>Total Price</label>
                                    <input type="text" class="span11" name="totalPrice" id="totalPrice" readonly value="0">
                                </div>
                            </div>
                            <div class="span1">
                                <div>
                                    <br>
                                    <label></label>
                                    <input type="button" class="span11 btn btn-success" value="Add" onclick="addSession()">
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="row-fluid" style="background-color: white; min-height: 800px; padding:10px;">
                    <div class="span10">
                        <center><h4>Book Order List</h4></center>
                        <div id="purchaseList"></div>
                        <h4>
                            <div style="float: right"><span style="float:left;">Total Amount: &#36;</span><span style="float: left" id="totalPurchase">0</span></div>
                        </h4>
                        <br><br>
                        <center>
                            <input type="submit" name="submit1" value="Confirm Order" class="btn btn-success">
                        </center>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript">
    function selectBookName(bookName){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("authorNameP").innerHTML=xmlhttp.responseText;
                $('#authorName').on('change', function(){
                    loadRetailPrice(document.getElementById("authorName").value);
                });
            }
        };
        xmlhttp.open("GET", "ajax/load-author-by-book-2.php?bookName="+bookName, true);
        xmlhttp.send();
    }
    function loadRetailPrice(authorName){
        var bookName=document.getElementById("bookName").value;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("retailPrice").value=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ajax/load-retail-price.php?bookName="+bookName+"&authorName="+authorName, true);
        xmlhttp.send();
    }
    function generateTotal(quantity){
        document.getElementById("totalPrice").value=eval(document.getElementById("retailPrice").value) * eval(document.getElementById("quantity").value);
    }
    function addSession(){
        var bookName=document.getElementById("bookName").value;
        var authorName=document.getElementById("authorName").value;
        var retailPrice=document.getElementById("retailPrice").value;
        var quantity=document.getElementById("quantity").value;
        var totalPrice=document.getElementById("totalPrice").value;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                if(xmlhttp.responseText==""){
                    purchaseBill();
                    alert("Book added successfully");
                }
                else{
                    purchaseBill();
                    alert(xmlhttp.responseText);
                }
            }
        };
        xmlhttp.open("GET", "ajax/save-session.php?bookName="+bookName+"&authorName="+authorName+"&retailPrice="+retailPrice+"&quantity="+quantity+"&totalPrice="+totalPrice, true);
        xmlhttp.send();
    }
    function purchaseBill(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("purchaseList").innerHTML=xmlhttp.responseText;
                totalAmountBill();
            }
        };
        xmlhttp.open("GET", "ajax/purchase-bill.php", true);
        xmlhttp.send();
    }
    function totalAmountBill(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById("totalPurchase").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ajax/total-amount-bill.php", true);
        xmlhttp.send();
    }
    function deleteQty(sessionid){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                if(xmlhttp.responseText==""){
                    purchaseBill();
                    alert("Book deleted successfully");
                }
                else{
                    purchaseBill();
                    alert(xmlhttp.responseText);
                }
            }
        };
        xmlhttp.open("GET", "ajax/delete-session.php?sessionid="+sessionid, true);
        xmlhttp.send();
    }
    purchaseBill();
    totalAmountBill();
</script>

<?php
function genBillNo($id){
    if($id==""){
        $id1=0;
    }
    else{
        $id1=$id;
    }
    $id1=$id1+1;
    $length=strlen($id1);
    if($length=="1"){
        $id1="0000".$id1;
    }
    if($length=="2"){
        $id1="000".$id1;
    }
    if($length=="3"){
        $id1="00".$id1;
    }
    if($length=="4"){
        $id1="0".$id1;
    }
    if($length=="5"){
        $id1=$id1;
    }
    return $id1;
}

if(isset($_POST["submit1"])){
    $lastBillNo=0;
    mysqli_query($link, "insert into bill_header values(NULL, '$_POST[billDate]', '$_POST[billNo]', '$_SESSION[admin]')") 
    or die(mysqli_error($link));
    $res=mysqli_query($link, "select * from bill_header order by id desc limit 1");
    while($row=mysqli_fetch_array($res)){
        $lastBillNo=$row["id"];
    }
    $max=sizeof($_SESSION['cart']);
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
                mysqli_query($link, "insert into bill_details values(NULL, '$lastBillNo', '$bookNameSession', '$authorNameSession', '$retailPriceSession', '$quantitySession')") 
                or die(mysqli_error($link));
                mysqli_query($link, "update book_current_stock set stockQuantity=stockQuantity-$quantitySession where bookName='$bookNameSession' && authorName='$authorNameSession'");
            }
        }
    }
    unset($_SESSION['cart']);
    ?>
    <script type="text/javascript">
        alert("Bill printed successfully");
        window.location.href=window.location.href;
    </script>
    <?php
}
?>

<?php
include "footer.php";
?>