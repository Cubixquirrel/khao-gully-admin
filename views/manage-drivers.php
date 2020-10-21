<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Manage Drivers';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/manage-drivers.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="manage-drivers-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="manage-drivers-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <?php
    $sql_select_driver = 'SELECT * FROM driver ORDER BY id DESC';
    $result_select_driver = $conn->query($sql_select_driver);

    if ($result_select_driver->num_rows > 0) {
        while ($row_select_driver = $result_select_driver->fetch_assoc()) {
            $id = $row_select_driver['id'];
            $driver_id = $row_select_driver['driver_id'];
            $driver_status = $row_select_driver['driver_status'];
            $driver_name = $row_select_driver['name'];
            $driver_address = $row_select_driver['address'];
            $driver_image = $row_select_driver['image'];
            $contact = $row_select_driver['contact'];            
            $pincode = $row_select_driver['pincode'];
            $email_id = $row_select_driver['email_id'];
            ?>
            <div class="your-driver-list">
                <div class="list-header">
                    <div class="header-block">
                        <span><?php echo $driver_name; ?></span>
                        <span>Driver ID: <?php echo $driver_id; ?></span>
                    </div>
                </div>

                <div class="list-body">

                    <div class="list-group">
                        <span>ADDRESS</span>
                        <span><?php echo $driver_address; ?></span>
                    </div>
                    
                    <div class="list-group">
                        <span>PINCODE</span>
                        <span><?php echo $pincode; ?></span>
                    </div>

                    <div class="list-group last">
                        <span>CONTACT</span>
                        <span><?php echo $contact; ?></span>
                        <span><?php echo $email_id; ?></span>
                    </div>
                </div>

                <div class="list-footer">
                    <div>
                        <span class="edit-button" onclick="editDriver('<?php echo $id; ?>')">Edit</span>
                    </div>
                    
                    <div>
                    <?php
                
                    if (($row_select_driver['driver_status'] == 'true') && ($row_select_driver['driver_login_status'] == '')) {
                        ?>
                        <span class="default online-active">Online</span>
                        <?php
                    } else if (($row_select_driver['driver_status'] == 'true') && ($row_select_driver['driver_login_status'] == 'false')) {
                        ?>
                        <span class="default offline-active">Offline</span>
                        <?php
                    }

                    if ($driver_status == '') {
                        ?><span class="update-status-button" onclick="updateDriverStatus('<?php echo $id; ?>')">Approve</span><?php
                    } else {
                        ?><span class="update-status-button active">Approved</span><?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?><span class="empty-box">No driver found</span><?php
    }
    ?>

    <script src="../assets/js/manage-drivers.js"></script>
</body>
</html>