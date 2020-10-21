<?php

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_admin_user = 'SELECT user_id FROM admin_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'"';
    $result_select_admin_user = $conn->query($sql_select_admin_user);
    
    if ($result_select_admin_user->num_rows === 1) {
        $row_select_admin_user = $result_select_admin_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM admin WHERE id = "'.$row_select_admin_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();

        $id            = $row_select_data['id'];
        $admin_id      = $row_select_data['admin_id'];
        $admin_name    = $row_select_data['admin_name'];
    } else {
        header ('location: ../views/login.php');
    } 
} else {
    header ('location: ../views/login.php');
}

?>