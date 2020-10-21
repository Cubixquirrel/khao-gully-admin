<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Admin Dashboard';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="dashboard-header">
        <div class="header-left">
            <span><?php echo $admin_name; ?></span>
            <span>Admin ID: <?php echo $admin_id; ?></span>
        </div>

        <div class="header-right">
            <span><?php echo strtoupper($admin_name[0]); ?></span>
        </div>
    </div>

    <div class="dashboard-menu">
        <div class="menu-first">
            <div class="dashboard-menu-list" onclick="openManageRestaurants()"><span>Manage Restaurants</span><i class="fas fa-chevron-right"></i></div>
            <div class="dashboard-menu-list" onclick="openManageDrivers()"><span>Manage Drivers</span><i class="fas fa-chevron-right"></i></div>
            <div class="dashboard-menu-list" onclick="openReports()"><span>Reports</span><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="menu-first">
            <div class="dashboard-menu-list" onclick="openEditItems()"><span>All Items</span><i class="fas fa-chevron-right"></i></div>
            <div class="dashboard-menu-list" onclick="openAllOrders()"><span>All Orders</span><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="menu-first">
            <div class="dashboard-menu-list" onclick="openAddCoupons()"><span>Add Coupons</span><i class="fas fa-chevron-right"></i></div>
            <div class="dashboard-menu-list" onclick="openManageCoupons()"><span>Edit Coupons</span><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="menu-first">
            <div class="dashboard-menu-list" onclick="openBirthdayAlerts()"><span>Birthday Alerts</span><i class="fas fa-chevron-right"></i></div>
            <div class="dashboard-menu-list" onclick="openUploadBanners()"><span>Upload Banners</span><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="menu-second">
            <div class="dashboard-menu-list" onclick="logout()"><span>Log Out</span><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>
    
    <script src="../assets/js/dashboard.js"></script>
</body>
</html>