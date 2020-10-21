<?php

include_once('../config/db.php');

$target_dir = "../../khao-gully-restaurant/uploads/document/";

foreach ($_FILES as $key => $value) {
    $basename = $_FILES[$key]['name'];
    $tmp_name = $_FILES[$key]['tmp_name'];
    $target_file = rand('1000000', '9999999') . '_' . basename($basename);
    $sql_name = 'image = "'.$target_file.'"';
}

if (move_uploaded_file($tmp_name, $target_dir . $target_file)) {
    $sql_update_image = 'UPDATE restaurant SET '.$sql_name.' WHERE id = "'.$_POST["restaurantId"].'"';
    $result_update_image = $conn->query($sql_update_image);

    echo $target_file;
}

?>