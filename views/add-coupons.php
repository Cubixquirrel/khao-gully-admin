<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Add Coupons';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/add-coupons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="add-coupons-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="add-coupons-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="add-coupons-form">
        <div id="add-coupons-form">
            <div class="pb-10">            

                
                <div id="" class="switch-main">
                    <span id="" class="switch-box expiry active" onclick="switchType('expiry', 'false')">Active</span>
                    <span id="" class="switch-box expiry" onclick="switchType('expiry', 'true')">Expired</span>
                </div>
                <input type="hidden" name="expiry" value="false">
                
                
                <div id="" class="switch-main">
                    <span id="" class="switch-box type active" onclick="switchType('type', 'Fixed')">Fixed</span>
                    <span id="" class="switch-box type" onclick="switchType('type', 'Percentage')">Percentage</span>
                </div>
                <input type="hidden" name="type" value="Fixed">


                <div class="label mt-25">
                    Coupon code (6 characters)
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" minlength="6" maxlength="6" max="6" name="couponCode" id="coupon-code" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                
                <div class="label mt-25">
                    Value
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" name="value" id="value" onkeyup="enableButton('1')">
                    </div>
                </div>


                <div class="label mt-25">
                    Minimum value
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" name="minValue" id="min-value" onkeyup="enableButton('1')">
                    </div>
                </div>
                

                <div class="label mt-25">
                    Description
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="description" id="description" onkeyup="enableButton('1')">
                    </div>
                </div>
                      
                
                <div class="button">
                    <input type="button" value="Add" id="add-button" onclick="addCoupon()">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/add-coupons.js"></script>
</body>
</html>