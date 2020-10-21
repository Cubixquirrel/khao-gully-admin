<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Edit Driver';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql_select_driver = 'SELECT * FROM driver WHERE id = "'.$_GET["id"].'"';
    $result_select_driver = $conn->query($sql_select_driver);
    $row_select_driver = $result_select_driver->fetch_assoc();
    
    $driver_id = $row_select_driver['id'];
    $name = $row_select_driver['name'];
} else {
    header ('location: ../views/manage-drivers.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-driver.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-driver-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-driver-title">
        <span><?php echo $name; ?></span>
    </div>

    <div class="edit-driver-form">
        <div id="edit-driver-form">
            <div class="pb-10">
                <div class="label">
                    Driver name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_driver['name']; ?>" name="driverName" id="driver-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Driver address
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_driver['address']; ?>" name="driverAddress" id="driver-address" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Pincode
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" value="<?php echo $row_select_driver['pincode']; ?>" minlength="6" maxlength="6" name="pincode" id="pincode" onkeyup="enableButton('1')">
                    </div>
                </div>
            
                <div class="label mt-25">
                    Email ID
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_driver['email_id']; ?>" name="emailId" id="email-id" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Mobile no.
                </div>

                <div class="input-group" style="margin: 20px 0;">
                    <img src="../assets/image/flag.png" width="24">

                    <div class="input-control-group">
                        <span>+91</span>
                        <input type="tel" value="<?php echo $row_select_driver['contact']; ?>" minlength="10" maxlength="10" name="mobileNumber" id="mobile-number" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Uploads
                </div>

                <div class="input-group upload-main">
                    <div class="input-control-group uploads-box">
                        <span>Aadhaar card</span>
                        <?php
                        if ($row_select_driver['aadhaar_card'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-driver/uploads/document/<?php echo $row_select_driver['aadhaar_card']; ?>" download="<?php echo $row_select_driver['aadhaar_card']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Cancelled cheque / bank passbook</span>
                        <?php
                        if ($row_select_driver['cheque_passbook'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-driver/uploads/document/<?php echo $row_select_driver['cheque_passbook']; ?>" download="<?php echo $row_select_driver['cheque_passbook']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Driver photo</span>
                        <?php
                        if ($row_select_driver['driver_photo'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-driver/uploads/document/<?php echo $row_select_driver['driver_photo']; ?>" download="<?php echo $row_select_driver['driver_photo']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>

                    <div class="input-control-group uploads-box">
                        <span>Driving licence</span>
                        <?php
                        if ($row_select_driver['driving_licence'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-driver/uploads/document/<?php echo $row_select_driver['driving_licence']; ?>" download="<?php echo $row_select_driver['driving_licence']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                </div>
                
                <div class="button">
                    <input type="button" value="Update" id="update-button" onclick="updateDriver('<?php echo $driver_id; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-driver.js"></script>
</body>
</html>