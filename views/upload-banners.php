<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Upload Banners';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/upload-banners.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="upload-banners-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="upload-banners-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="upload-banners-form">
        <div id="upload-banners-form">
            <div class="pb-10">
                <div class="label"></div>

                <div class="input-group upload-main">                    
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        ?>                        
                        <div class="input-control-group uploads-box">
                            <span>Users Banner <?php echo $i; ?></span>
                            <span class="upload-button" onclick="selectUpload('users-banner-<?php echo $i; ?>')">Upload</span>
                            <input type="file" name="usersBanner<?php echo $i; ?>" id="users-banner-<?php echo $i; ?>" onchange="validateUpload('users-banner-<?php echo $i; ?>')">
                            <input type="hidden" id="users-banner-<?php echo $i; ?>-value">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="pb-10">
                <div class="label"></div>

                <div class="input-group upload-main">
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        ?>                        
                        <div class="input-control-group uploads-box">
                            <span>Restaurant Banner <?php echo $i; ?></span>
                            <span class="upload-button" onclick="selectUpload('restaurant-banner-<?php echo $i; ?>')">Upload</span>
                            <input type="file" name="restaurantBanner<?php echo $i; ?>" id="restaurant-banner-<?php echo $i; ?>" onchange="validateUpload('restaurant-banner-<?php echo $i; ?>')">
                            <input type="hidden" id="restaurant-banner-<?php echo $i; ?>-value">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="pb-10">
                <div class="label"></div>

                <div class="input-group upload-main">
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        ?>                        
                        <div class="input-control-group uploads-box">
                            <span>Drivers Banner <?php echo $i; ?></span>
                            <span class="upload-button" onclick="selectUpload('drivers-banner-<?php echo $i; ?>')">Upload</span>
                            <input type="file" name="driversBanner<?php echo $i; ?>" id="drivers-banner-<?php echo $i; ?>" onchange="validateUpload('drivers-banner-<?php echo $i; ?>')">
                            <input type="hidden" id="drivers-banner-<?php echo $i; ?>-value">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/upload-banners.js"></script>
</body>
</html>-