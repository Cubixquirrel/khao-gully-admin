<?php

include_once('../config/db.php');

if (
    ($_POST['driverName'] != '') && 
    ($_POST['driverAddress'] != '') && 
    ($_POST['pincode'] != '') && 
    ($_POST['emailId'] != '') && 
    ($_POST['mobileNumber'] != '')
) {
    $driver_id = $_POST['driverId'];
    $driver_name = ucwords($_POST['driverName']);
    $driver_address = ucwords($_POST['driverAddress']);
    $pincode = $_POST['pincode'];
    $email_id = strtolower($_POST['emailId']);
    $mobile_number = $_POST['mobileNumber'];

    $sql_update_driver = 
    '
    UPDATE driver SET 
    name = "'.$driver_name.'", address = "'.$driver_address.'", pincode = "'.$pincode.'", 
    email_id = "'.$email_id.'", contact = "'.$mobile_number.'" WHERE id = "'.$driver_id.'"
    ';
    // echo $sql_update_driver;
    $result_update_driver = $conn->query($sql_update_driver);
    
    if ($result_update_driver) {
        echo 'true';
    }
}

?>