<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Manage Coupons';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/manage-coupons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="manage-coupons-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="manage-coupons-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="coupon-main">
        <?php
        $sql_select_coupon = 'SELECT * FROM coupon ORDER BY id DESC';
        $result_select_coupon = $conn->query($sql_select_coupon);
        while($row_select_coupon = $result_select_coupon->fetch_assoc()) {
            $coupon_code = $row_select_coupon['coupon_code'];
            $coupon_description = $row_select_coupon['coupon_description'];
            $coupon_expiry = $row_select_coupon['coupon_expiry'];

            ?>
            <div class="coupon-card">
                <?php
                if ($row_select_coupon['coupon_expiry'] == 'false') {
                    $coupon_expiry = 'false';
                    $coupon_text = 'Active';
                    $color = 'red';
                } else if ($row_select_coupon['coupon_expiry'] == 'true') {
                    $coupon_expiry = 'true';
                    $coupon_text = 'Expired';
                    $color = 'grey';
                }
                ?>
                <span class="coupon-text-<?php echo $color; ?>"><?php echo $coupon_code; ?></span>
                <span><span class="uppercase">Description:</span> <?php echo $coupon_description; ?></span>
                <span><span class="uppercase">Type:</span> <?php echo $row_select_coupon['coupon_type']; ?></span>
                <?php
                if ($row_select_coupon['coupon_type'] == 'Percentage') {
                    ?><span><span class="uppercase">Value:</span> <?php echo $row_select_coupon['coupon_value']; ?>%</span><?php
                } else if ($row_select_coupon['coupon_type'] == 'Fixed') {
                    ?><span><span class="uppercase">Value:</span> Rs. <?php echo $row_select_coupon['coupon_value']; ?></span><?php
                }
                ?>
                <div>
                <span onclick="openEditCoupon('<?php echo $row_select_coupon['id']; ?>')">Edit</span>
                <span class="expiry-<?php echo $coupon_expiry; ?>"><?php echo $coupon_text; ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <script src="../assets/js/manage-coupons.js"></script>
</body>
</html>