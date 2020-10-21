<?php

include_once('../config/db.php');

if (
    ($_POST['couponExpiry'] != '') && 
    ($_POST['couponType'] != '') && 
    ($_POST['couponCode'] != '') && 
    ($_POST['couponValue'] != '') && 
    ($_POST['minValue'] != '') && 
    ($_POST['description'] != '')
) {
    $coupon_expiry = $_POST['couponExpiry'];
    $coupon_type = $_POST['couponType'];
    $coupon_code = strtoupper($_POST['couponCode']);
    $coupon_value = $_POST['couponValue'];
    $min_value = $_POST['minValue'];
    $description = ucwords($_POST['description']);

    $sql_insert_coupon = 
    '
    INSERT INTO coupon (
        coupon_expiry,
        coupon_type,
        coupon_code,
        coupon_value,
        min_value,
        coupon_description
    ) VALUES (
        "'.$coupon_expiry.'",
        "'.$coupon_type.'",
        "'.$coupon_code.'",
        "'.$coupon_value.'",
        "'.$min_value.'",
        "'.$description.'"
    )
    ';
    $result_insert_coupon = $conn->query($sql_insert_coupon);
    
    if ($result_insert_coupon) {
        echo 'true';
    }
}

?>