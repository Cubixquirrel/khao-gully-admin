<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

if (isset($_GET['couponId']) && $_GET['couponId'] != '') {
    $sql_select_coupon = 'SELECT * FROM coupon WHERE id  = "'.$_GET["couponId"].'"';
    $result_select_copon = $conn->query($sql_select_coupon);
    $row_select_coupon = $result_select_copon->fetch_assoc();
}

$page_title = $row_select_coupon['coupon_code'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-coupon.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-coupon-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-coupon-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="edit-coupon-form">
        <div id="edit-coupon-form">
            <div class="pb-10">            

                <?php
                if ($row_select_coupon['coupon_expiry'] == 'false') {
                    ?>
                    <div id="" class="switch-main">
                        <span id="" class="switch-box expiry active" onclick="switchType('expiry', 'false')">Active</span>
                        <span id="" class="switch-box expiry" onclick="switchType('expiry', 'true')">Expired</span>
                    </div>
                    <input type="hidden" name="expiry" value="false">
                    <?php
                } else if ($row_select_coupon['coupon_expiry'] == 'true') {
                    ?>
                    <div id="" class="switch-main">
                        <span id="" class="switch-box expiry" onclick="switchType('expiry', 'false')">Active</span>
                        <span id="" class="switch-box expiry active" onclick="switchType('expiry', 'true')">Expired</span>
                    </div>
                    <input type="hidden" name="expiry" value="true">
                    <?php
                }
                ?>


                <?php
                if ($row_select_coupon['coupon_type'] == 'Fixed') {
                    ?>
                    <div id="" class="switch-main">
                        <span id="" class="switch-box type active" onclick="switchType('type', 'Fixed')">Fixed</span>
                        <span id="" class="switch-box type" onclick="switchType('type', 'Percentage')">Percentage</span>
                    </div>
                    <input type="hidden" name="type" value="Fixed">
                    <?php
                } else if ($row_select_coupon['coupon_type'] == 'Percentage') {
                    ?>                
                    <div id="" class="switch-main">
                        <span id="" class="switch-box type" onclick="switchType('type', 'Fixed')">Fixed</span>
                        <span id="" class="switch-box type active" onclick="switchType('type', 'Percentage')">Percentage</span>
                    </div>
                    <input type="hidden" name="type" value="Percentage">
                    <?php
                }
                ?>


                <div class="label mt-25">
                    Coupon code (6 characters)
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_coupon['coupon_code']; ?>" minlength="6" maxlength="6" max="6" name="couponCode" id="coupon-code" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                
                <div class="label mt-25">
                    Value
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" value="<?php echo $row_select_coupon['coupon_value']; ?>" name="value" id="value" onkeyup="enableButton('1')">
                    </div>
                </div>


                <div class="label mt-25">
                    Minimum value
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" value="<?php echo $row_select_coupon['min_value']; ?>" name="minValue" id="min-value" onkeyup="enableButton('1')">
                    </div>
                </div>
                

                <div class="label mt-25">
                    Description
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_coupon['coupon_description']; ?>" name="description" id="description" onkeyup="enableButton('1')">
                    </div>
                </div>
                      
                
                <div class="button">
                    <input type="button" value="Update" id="update-button" onclick="updateCoupon('<?php echo $row_select_coupon['id']; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-coupon.js"></script>
</body>
</html>