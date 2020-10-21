<?php

include_once('../config/db.php');

if (
    ($_POST['outletName'] != '') && 
    ($_POST['outletAddress'] != '') && 
    ($_POST['pincode'] != '') && 
    ($_POST['contactPersonsName'] != '') && 
    ($_POST['emailId'] != '') && 
    ($_POST['mobileNumber'] != '') && 
    ($_POST['mainTag'] != '') && 
    ($_POST['cuisines'] != '') && 
    ($_POST['averagePricing'] != '')
) {
    $restaurant_id = $_POST['restaurantId'];
    $outlet_name = ucwords($_POST['outletName']);
    $outlet_address = ucwords($_POST['outletAddress']);
    $pincode = $_POST['pincode'];
    $contact_persons_name = ucwords($_POST['contactPersonsName']);
    $email_id = strtolower($_POST['emailId']);
    $mobile_number = $_POST['mobileNumber'];
    $main_tag = ucwords($_POST['mainTag']);
    $cuisines = ucwords($_POST['cuisines']);
    $average_pricing = $_POST['averagePricing'];

    $sun_timing = $_POST['sunTiming1'].$_POST['sunAmPm1'].' - '.$_POST['sunTiming2'].$_POST['sunAmPm2'];
    $mon_timing = $_POST['monTiming1'].$_POST['monAmPm1'].' - '.$_POST['monTiming2'].$_POST['monAmPm2'];
    $tue_timing = $_POST['tueTiming1'].$_POST['tueAmPm1'].' - '.$_POST['tueTiming2'].$_POST['tueAmPm2'];
    $wed_timing = $_POST['wedTiming1'].$_POST['wedAmPm1'].' - '.$_POST['wedTiming2'].$_POST['wedAmPm2'];
    $thu_timing = $_POST['thuTiming1'].$_POST['thuAmPm1'].' - '.$_POST['thuTiming2'].$_POST['thuAmPm2'];
    $fri_timing = $_POST['friTiming1'].$_POST['friAmPm1'].' - '.$_POST['friTiming2'].$_POST['friAmPm2'];
    $sat_timing = $_POST['satTiming1'].$_POST['satAmPm1'].' - '.$_POST['satTiming2'].$_POST['satAmPm2'];

    $sql_update_restaurant = 
    '
    UPDATE restaurant SET 
    name = "'.$outlet_name.'", address = "'.$outlet_address.'", pincode = "'.$pincode.'", 
    contact_persons_name = "'.$contact_persons_name.'", email_id = "'.$email_id.'", contact = "'.$mobile_number.'", 
    main_tag = "'.$main_tag.'", cuisines = "'.$cuisines.'", average_pricing = "'.$average_pricing.'", 
    sun_timing = "'.$sun_timing.'", mon_timing = "'.$mon_timing.'", tue_timing = "'.$tue_timing.'", wed_timing = "'.$wed_timing.'", 
    thu_timing = "'.$thu_timing.'", fri_timing = "'.$fri_timing.'", sat_timing = "'.$sat_timing.'" 
    WHERE id = "'.$restaurant_id.'"
    ';
    // echo $sql_update_restaurant;
    $result_update_restaurant = $conn->query($sql_update_restaurant);
    
    if ($result_update_restaurant) {
        echo 'true';
    }
}

?>