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
include "mysqlconnection.php";
$id=$_GET["id"];
mysqli_query($link, "delete from vendor_details where id=$id");
?>

<script type="text/javascript">
    window.location="vendor-details.php";
</script>