<?php

include_once('../config/db.php');

if (
    ($_POST['restaurantId'] != '')
) {
    $restaurant_id = $_POST['restaurantId'];

    $sql_update_restaurant_id = 
    '
    UPDATE restaurant SET restaurant_status = "true" WHERE id = "'.$restaurant_id.'"
    ';
    $result_update_restaurant_id = $conn->query($sql_update_restaurant_id);
    
    if ($result_update_restaurant_id) {
        echo 'true';
    }
}

?>