<?php

include_once('../config/db.php');

$target_dir = "../uploads/banner/";

foreach ($_FILES as $key => $value) {
    $basename = $_FILES[$key]['name'];
    $tmp_name = $_FILES[$key]['tmp_name'];
    $target_file = rand('1000000', '9999999') . '_' . basename($basename);
    $sql_name = ''.$key.' = "'.$target_file.'"';
}

if (move_uploaded_file($tmp_name, $target_dir . $target_file)) {
    $sql_update_banners = 'UPDATE banners SET '.$sql_name.' WHERE id = "1"';
    $result_update_banners = $conn->query($sql_update_banners);

    echo $target_file;
}

?>