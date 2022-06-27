<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akkad Bookstore Inventory Management System</title>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/matrix-media.css"/>
    <link rel="stylesheet" href="css/matrix-style.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="header">
    <h2 style="color: white;position: absolute">
        <a href="dashboard.html" style="color:white; margin-left: 55px; margin-top: 40px">User</a>
    </h2>
</div>

<!--upper left menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
            <span class="text"><i class="icon-user"></i> </span><b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="icon-user"></i><b> User Profile</b></a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="icon-share-alt"></i><b>Log Out</b></a></li>
            </ul>
        </li>
    </ul>
</div>

<!--side menu-->
<div id="sidebar">
    <ul>
        <li>
            <a href="dashboard.php"><i class="icon icon-dashboard"></i><span><b>Dashboard</b></span></a>
        </li>
        <li>
            <a href="book-current-stock.php"><i class="icon-hdd"></i><span><b>Current Inventory</b></span></a>
        </li>
        <li>
            <a href="book-purchase.php"><i class="icon-download-alt"></i><span><b>Product Purchase Order</b></span></a>
        </li>
        <li>
            <a href="book-sale.php"><i class="icon-print"></i><span><b>Product Sales</b></span></a>
        </li>
        <li class="submenu"><a href="#"><i class="icon-bar-chart"></i><span><b>Report</b></span></a>
            <ul>
                <li><a href="purchase-record.php"><b>Purchase Order Report</b></a></li>
                <li><a href="bill-record.php"><b>Sales Report</b></a></li>
            </ul>
        </li>
    </ul>
</div>
