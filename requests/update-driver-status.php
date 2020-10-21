<?php

include_once('../config/db.php');

if (
    ($_POST['driverId'] != '')
) {
    $driver_id = $_POST['driverId'];

    $sql_update_driver_id = 
    '
    UPDATE driver SET driver_status = "true" WHERE id = "'.$driver_id.'"
    ';
    $result_update_driver_id = $conn->query($sql_update_driver_id);
    
    if ($result_update_driver_id) {
        echo 'true';
    }
}

?>