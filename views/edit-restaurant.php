<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Edit Restaurant';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$_GET["id"].'"';
    $result_select_restaurant = $conn->query($sql_select_restaurant);
    $row_select_restaurant = $result_select_restaurant->fetch_assoc();
    
    $restaurant_id = $row_select_restaurant['id'];
    $name = $row_select_restaurant['name'];
} else {
    header ('location: ../views/manage-restaurants.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-restaurant.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-restaurant-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-restaurant-title">
        <span><?php echo $name; ?></span>
    </div>

    <div class="edit-restaurant-form">
        <div id="edit-restaurant-form">
            <div class="pb-10">
                <div class="label">
                    Outlet name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['name']; ?>" name="outletName" id="outlet-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Outlet address
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['address']; ?>" name="outletAddress" id="outlet-address" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Pincode
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" value="<?php echo $row_select_restaurant['pincode']; ?>" minlength="6" maxlength="6" name="pincode" id="pincode" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Contact person's name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['contact_persons_name']; ?>" name="contactPersonsName" id="contact-persons-name" onkeyup="enableButton('1')">
                    </div>
                </div>
            
                <div class="label mt-25">
                    Email ID
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['email_id']; ?>" name="emailId" id="email-id" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Mobile no.
                </div>

                <div class="input-group" style="margin: 20px 0;">
                    <img src="../assets/image/flag.png" width="24">

                    <div class="input-control-group">
                        <span>+91</span>
                        <input type="tel" value="<?php echo $row_select_restaurant['contact']; ?>" minlength="10" maxlength="10" name="mobileNumber" id="mobile-number" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Main Category
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['main_tag']; ?>" name="mainTag" id="main-tag" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Cuisines
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" value="<?php echo $row_select_restaurant['cuisines']; ?>" name="cuisines" id="cuisines" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Average pricing
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" value="<?php echo $row_select_restaurant['average_pricing']; ?>" name="averagePricing" id="average-pricing" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Uploads
                </div>

                <div class="input-group upload-main">
                    <div class="input-control-group uploads-box">
                        <span>Aadhaar card</span>
                        <?php
                        if ($row_select_restaurant['aadhaar_card'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['aadhaar_card']; ?>" download="<?php echo $row_select_restaurant['aadhaar_card']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Cancelled cheque / bank passbook</span>
                        <?php
                        if ($row_select_restaurant['cheque_passbook'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['cheque_passbook']; ?>" download="<?php echo $row_select_restaurant['cheque_passbook']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Owner photo</span>
                        <?php
                        if ($row_select_restaurant['owner_photo'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['owner_photo']; ?>" download="<?php echo $row_select_restaurant['owner_photo']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>

                    <div class="input-control-group uploads-box">
                        <span>FSSAI licence</span>
                        <?php
                        if ($row_select_restaurant['fssai_licence'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['fssai_licence']; ?>" download="<?php echo $row_select_restaurant['fssai_licence']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>GST number</span>
                        <?php
                        if ($row_select_restaurant['gst_number'] != '') {
                            ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['gst_number']; ?>" download="<?php echo $row_select_restaurant['gst_number']; ?>">Download</a><?php
                        } else {
                            ?><a class="upload-button empty">No Download Available</a><?php
                        }
                        ?>
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Restaurant image</span>
                        <div>
                            <span class="upload-button" onclick="selectUpload('restaurant-image')">Upload</span>
                            <input type="file" style="display: none" name="restaurantImage" id="restaurant-image" onchange="validateUpload('restaurant-image', '<?php echo $restaurant_id; ?>')">
                            <input type="hidden" id="restaurant-image-value">
                            <?php
                            if ($row_select_restaurant['image'] != '') {
                                ?><a class="upload-button" href="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['image']; ?>" download="<?php echo $row_select_restaurant['image']; ?>">Download</a><?php
                            } else {
                                ?><a class="upload-button empty">No Download Available</a><?php
                            }
                            ?>                            
                        </div>
                    </div>
                </div>

                <div class="label mt-25">
                    Opening hours
                </div>

                <?php
                for ($x = 0; $x < 7; $x++) {
                    if ($x == 0) $date = 'sun';
                    if ($x == 1) $date = 'mon';
                    if ($x == 2) $date = 'tue';
                    if ($x == 3) $date = 'wed';
                    if ($x == 4) $date = 'thu';
                    if ($x == 5) $date = 'fri';
                    if ($x == 6) $date = 'sat';

                    $row = $date.'_timing';
                    $timing = explode(' - ', $row_select_restaurant[$row]);
                    $am_pm_1 = substr(explode(' - ', $row_select_restaurant[$row])[0], -2);
                    $am_pm_2 = substr(explode(' - ', $row_select_restaurant[$row])[1], -2);                    
                    $timing_1 = str_replace($am_pm_1, '', $timing[0]);
                    $timing_2 = str_replace($am_pm_2, '', $timing[1]);                    
                    ?>                    
                    <div class="input-group">
                        <div class="input-control-group timing-group">
                            <span><?php echo ucwords($date); ?></span>

                            <div>
                                <select name="<?php echo $date; ?>Timing1" id="<?php echo $date; ?>-timing-1" onchange="enableSaveChanges()">
                                    <option value="<?php echo $timing_1; ?>" selected><?php echo $timing_1; ?></option>
                                    <option value="" disabled>--</option>
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <select name="<?php echo $date; ?>AmPm1" id="<?php echo $date; ?>-am-pm-1" onchange="enableSaveChanges()">
                                    <option value="<?php echo $am_pm_1; ?>" selected><?php echo $am_pm_1; ?></option>
                                    <option value="" disabled>--</option>
                                    <option value="am">am</option>
                                    <option value="pm">pm</option>
                                </select>
                                <span class="timing-separator"></span>
                                <select name="<?php echo $date; ?>Timing2" id="<?php echo $date; ?>-timing-2" onchange="enableSaveChanges()">
                                    <option value="<?php echo $timing_2; ?>" selected><?php echo $timing_2; ?></option>
                                    <option value="" disabled>--</option>
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <select name="<?php echo $date; ?>AmPm2" id="<?php echo $date; ?>-am-pm-2" onchange="enableSaveChanges()">
                                    <option value="<?php echo $am_pm_2; ?>" selected><?php echo $am_pm_2; ?></option>
                                    <option value="" disabled>--</option>
                                    <option value="am">am</option>
                                    <option value="pm">pm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                
                <div class="button">
                    <input type="button" value="Update" id="update-button" onclick="updateRestaurant('<?php echo $restaurant_id; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-restaurant.js"></script>
</body>
</html>