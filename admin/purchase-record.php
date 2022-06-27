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
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="purchase-record.php" class="tip-bottom"><i class="icon-bar-chart"></i><b>Purchase Order Report</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Purchase Order Record List</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Vendor</th>
                                    <th>Book Name</th>
                                    <th>Author Name</th>
                                    <th>Order Quantity</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Ordered By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res=mysqli_query($link, "select * from book_purchase");
                                while($row=mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <td><?php print $row["vendorName"]; ?></td>
                                        <td><?php print $row["bookName"]; ?></td>
                                        <td><?php print $row["authorName"]; ?></td>
                                        <td><?php print $row["purchaseQuantity"]; ?></td>
                                        <td>$<?php print $row["purchasePrice"]; ?></td>
                                        <td><?php print $row["purchaseDate"]; ?></td>
                                        <td><?php print $row["username"]; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
