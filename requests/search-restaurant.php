<?php

include_once('../config/db.php');

if (($_POST['restaurantName'] != '')) {
    $restaurant_name = $_POST['restaurantName'];

    $sql_select_restaurant = 'SELECT * FROM restaurant WHERE name like "%'.$restaurant_name.'%" ORDER BY name ASC';
    $result_select_restaurant = $conn->query($sql_select_restaurant);
    if ($result_select_restaurant->num_rows > 0) {
        while ($row_select_restaurant = $result_select_restaurant->fetch_assoc()) {
            $post_data = "".$row_select_restaurant['id']."_%_".$row_select_restaurant['name']."__%__";  
            echo $post_data;
        }
    } else {
        echo 'false';
    }
}

?>