<?php
session_start();
if(!isset($_SESSION["user"])){
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
?>

<?php
include "header.php";
include "../admin/mysqlconnection.php";
$id=$_GET["id"];
$purchaseDate="";
$billNo="";
$res=mysqli_query($link, "select * from bill_header where id=$id");
while($row=mysqli_fetch_array($res)){
    $purchaseDate=$row["purchaseDate"];
    $billNo=$row["billNo"];
}
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="bill-record.php" class="tip-bottom"><i class="icon-bar-chart"></i><b>Product Sales Report</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <center>
                    <h4>Bill Details</h4>
                </center>
                <table>
                    <tr>
                        <td>Bill No </td>
                        <td>: <?php print $billNo; ?></td>
                    </tr>
                    <tr>
                        <td>Order Date </td>
                        <td>: <?php print $purchaseDate; ?></td>
                    </tr>
                </table>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Author Name</th>
                            <th>Quantity</th>
                            <th>Retail Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total=0;
                        $res=mysqli_query($link, "select * from bill_details where billId=$id");
                        while($row=mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td><?php print $row["bookName"]; ?></td>
                            <td><?php print $row["authorName"]; ?></td>
                            <td><?php print $row["quantity"]; ?></td>
                            <td>$<?php print $row["retailPrice"]; ?></td>
                        </tr>
                        <?php
                        $total=$total+($row["retailPrice"]*$row["quantity"]);
                        }
                        ?>
                    </tbody>
                </table>
                <div align="right" style="font-weight: bold">
                Total Amount : $<?php print $total; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
