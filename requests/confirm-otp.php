<?php

include_once('../config/db.php');

function generateToken($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (
    ((isset($_POST['mobile'])) && ($_POST['mobile'] != '')) && 
    ((isset($_POST['otp'])) && ($_POST['otp'] != ''))
) {
    $mobile_number = $_POST['mobile'];
    $otp = $_POST['otp'];
    
    $sql_select_otp = 'SELECT * FROM otp WHERE mobile = "'.$mobile_number.'" ORDER BY id DESC LIMIT 1';
    $result_select_otp = $conn->query($sql_select_otp);

    if ($result_select_otp->num_rows === 1) {
        $row_select_otp = $result_select_otp->fetch_assoc();

        if ($row_select_otp['otp'] == $otp) {
            $status = 'true';

            $sql_select_admin = 'SELECT * FROM admin WHERE admin_id = "'.$mobile_number.'" ORDER BY id DESC LIMIT 1';            
            $result_select_admin = $conn->query($sql_select_admin);
            $row_select_admin = $result_select_admin->fetch_assoc();
            $id = $row_select_admin['id'];
            // echo $sql_select_admin;
    
            if ($result_select_admin->num_rows === 1) {
                $user_auth = generateToken(80);
                $user_status = 'true';
    
                $sql_select_id = 'SELECT * FROM admin_users_login WHERE user_id = "'.$id.'"';
                $result_select_id = $conn->query($sql_select_id);
    
                if ($result_select_id->num_rows === 1) {
                    $sql_update_status = 
                    '
                    UPDATE admin_users_login SET
                    user_auth = "'.$user_auth.'",
                    user_status = "'.$user_status.'"
                    WHERE user_id = "'.$id.'"
                    ';
                    $result_update_status = $conn->query($sql_update_status);
    
                    if ($result_update_status) {
                        setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
                        setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');
    
                        echo $status;
                    }
                } else {    
                    $sql_insert_status = 
                    '
                    INSERT INTO admin_users_login (
                        user_id,
                        user_auth,
                        user_status
                    ) VALUES (
                        "'.$id.'",
                        "'.$user_auth.'",
                        "'.$user_status.'"
                    )
                    ';
                    $result_insert_status = $conn->query($sql_insert_status);
            
                    if ($result_insert_status) {
                        setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
                        setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');
            
                        echo $status;
                    }
                }
            }
        } else {
            $status = 'false';
            echo $status;
        }
    }
}

?>