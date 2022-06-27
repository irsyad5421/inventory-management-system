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
        <div id="breadcrumb"><a href="bill-record.php" class="tip-bottom"><i class="icon-bar-chart"></i><b>Product Sales Report</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span10">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Customer Order Record List</h5>
                    </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Bill No</th>
                                        <th>Order Date</th>
                                        <th>Total Amount</th>
                                        <th>Bill Confirmed By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res=mysqli_query($link, "select * from bill_header order by id desc");
                                    while($row=mysqli_fetch_array($res)){
                                        print "<tr>";
                                        print "<td>"; print $row["billNo"]; print "</td>";
                                        print "<td>"; print $row["purchaseDate"]; print "</td>";
                                        print "<td>$"; print getTotal($row["id"], $link); print "</td>";
                                        print "<td>"; print $row["username"]; print "</td>";
                                        print "<td>"; ?> <a href="bill-details-record.php?id=<?php print $row ["id"]; ?>" style="color:blue">View Details<?php print "</td>";
                                        print "</tr>";
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
function getTotal($billID, $link){
    $totalBill=0;
    $res2=mysqli_query($link, "select * from bill_details where billId=$billID");
    while($row2=mysqli_fetch_array($res2)){
        $totalBill=$totalBill+($row2["retailPrice"]*$row2["quantity"]);
    }
    return $totalBill;
}
?>

<?php
include "footer.php";
?>
