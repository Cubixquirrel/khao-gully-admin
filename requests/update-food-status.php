<?php

include_once('../config/db.php');

if (
    ($_POST['foodId'] != '')
) {
    $food_id = $_POST['foodId'];

    $sql_update_food_id = 
    '
    UPDATE food SET food_status = "true" WHERE id = "'.$food_id.'"
    ';
    $result_update_food_id = $conn->query($sql_update_food_id);
    
    if ($result_update_food_id) {
        echo 'true';
    }
}

?>