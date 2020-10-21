<?php

include_once('../config/db.php');

if (
    ($_POST['couponId'] != '') && 
    ($_POST['couponExpiry'] != '') && 
    ($_POST['couponType'] != '') && 
    ($_POST['couponCode'] != '') && 
    ($_POST['couponValue'] != '') && 
    ($_POST['minValue'] != '') && 
    ($_POST['description'] != '')
) {
    $coupon_id = $_POST['couponId'];
    $coupon_expiry = $_POST['couponExpiry'];
    $coupon_type = $_POST['couponType'];
    $coupon_code = strtoupper($_POST['couponCode']);
    $coupon_value = $_POST['couponValue'];
    $min_value = $_POST['minValue'];
    $description = ucwords($_POST['description']);

    $sql_update_coupon = 
    '
    UPDATE coupon SET 
        coupon_expiry = "'.$coupon_expiry.'",
        coupon_type = "'.$coupon_type.'",
        coupon_code = "'.$coupon_code.'",
        coupon_value = "'.$coupon_value.'",
        min_value = "'.$min_value.'",
        coupon_description = "'.$description.'" 
    WHERE id = "'.$coupon_id.'"
    ';
    $result_update_coupon = $conn->query($sql_update_coupon);
    
    if ($result_update_coupon) {
        echo 'true';
    }
}

?>