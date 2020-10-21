<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'All Orders';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/all-orders.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="all-orders-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="all-orders-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <?php
    $sql_select_order = 'SELECT * FROM order_id ORDER BY id DESC';
    $result_select_order = $conn->query($sql_select_order);

    if ($result_select_order->num_rows > 0) {
        while ($row_select_order = $result_select_order->fetch_assoc()) {
            $order_id = $row_select_order['id'];
            $restaurant_id = $row_select_order['restaurant_id'];
            $user_id = $row_select_order['user_id'];
            $driver_id = $row_select_order['driver_id'];
            $order_id = $row_select_order['order_id'];
            $order_created_on = $row_select_order['order_created_on'];
            $order_grand_total = $row_select_order['grand_total'];
            $order_status = $row_select_order['order_status'];
            $user_name = $row_select_order['user_name'];
            $user_mobile = $row_select_order['user_mobile'];
            $user_location = $row_select_order['user_location'];
            $payment_type = $row_select_order['payment_type'];

            $sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$restaurant_id.'"';
            $result_select_restaurant = $conn->query($sql_select_restaurant);
            $row_select_restaurant = $result_select_restaurant->fetch_assoc();
            $restaurant_name = $row_select_restaurant['name'];
            $restaurant_address = $row_select_restaurant['address'];
            $restaurant_pincode = $row_select_restaurant['pincode'];
            $restaurant_contact = $row_select_restaurant['contact'];

            $sql_select_driver = 'SELECT * FROM driver WHERE id = "'.$driver_id.'"';
            $result_select_driver = $conn->query($sql_select_driver);
            $row_select_driver = $result_select_driver->fetch_assoc();
            ?>
            <div class="your-order-list">
                <div class="list-header">
                    <div class="header-block">
                        <span><?php echo $order_created_on; ?></span>
                        <span>Rs. <?php echo $order_grand_total; ?></span>
                    </div>
                </div>

                <div class="list-body">
                    <div class="list-group">
                        <span>ORDER ID</span>
                        <span><?php echo $order_id; ?></span>
                    </div>
                    
                    <div class="list-group">
                        <span>MODE OF PAYMENT</span>
                        <span><?php echo $payment_type; ?></span>
                    </div>

                    <div class="list-group">
                        <span>RESTAURANT</span>
                        <span><?php echo $restaurant_name; ?></span>
                        <span>Address: <?php echo $restaurant_address . ' - ' . $restaurant_pincode; ?></span>
                        <span>Mobile: <?php echo $restaurant_contact; ?></span>
                    </div>

                    <div class="list-group">
                        <span>CUSTOMER</span>
                        <span><?php echo $user_name; ?></span>
                        <span>Address: <?php echo $user_location; ?></span>
                        <span>Mobile: <?php echo $user_mobile; ?></span>
                    </div>

                    <div class="list-group last">
                        <span>DRIVER</span>
                        <?php
                        if ($driver_id != '') {
                            ?>
                            <span><?php echo $row_select_driver['name']; ?></span>
                            <span>Mobile: <?php echo $row_select_driver['contact']; ?></span>
                            <?php
                        } else {
                            ?>
                            <span>No Driver</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="list-footer">
                    <span><?php echo $order_status; ?></span>
                </div>
            </div>
            <?php
        }
    } else {
        ?><span class="empty-box">No order found.</span><?php
    }
    ?>

    <script src="../assets/js/all-orders.js"></script>
</body>
</html>