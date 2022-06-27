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
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="dashboard.php" class="tip-bottom"><i class="icon-dashboard"></i><b>Dashboard</b></a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="card" style="width: 18rem; border-style: solid; border-width: 2px; border-radius: 10px; float: left">
                <div class="card-body">
                    <h4 class="card-title text-center">Current Book Inventory</h4>
                    <h1 class="card-title text-center">
                        <?php
                        $count=0;
                        $res=mysqli_query($link, "select * from book_current_stock");
                        $count=mysqli_num_rows($res);
                        print $count;
                        ?>
                    </h1>
                </div>
            </div>
            <div class="card" style="width: 18rem; border-style: solid; border-width: 2px; border-radius: 10px; float: left; margin-left: 10px">
                <div class="card-body">
                    <h4 class="card-title text-center">Total Book Purchase</h4>
                    <h1 class="card-title text-center">
                        <?php
                        $count=0;
                        $res=mysqli_query($link, "select * from book_purchase");
                        $count=mysqli_num_rows($res);
                        print $count;
                        ?>
                    </h1>
                </div>
            </div>
            <div class="card" style="width: 18rem; border-style: solid; border-width: 2px; border-radius: 10px; float: left; margin-left: 10px">
                <div class="card-body">
                    <h4 class="card-title text-center">Total Book Sales</h4>
                    <h1 class="card-title text-center">
                        <?php
                        $count=0;
                        $res=mysqli_query($link, "select * from bill_header");
                        $count=mysqli_num_rows($res);
                        print $count;
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
