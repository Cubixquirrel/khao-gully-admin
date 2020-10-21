<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

date_default_timezone_set('Asia/Kolkata');

$page_title = 'Birthday Alerts';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/birthday-alerts.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="birthday-alerts-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="birthday-alerts-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="birthday-main">
        <?php
        $sql_select_users = 'SELECT * FROM users ORDER BY user_name ASC';
        $result_select_users = $conn->query($sql_select_users);
        $status = '';
        while($row_select_users = $result_select_users->fetch_assoc()) {
            if ($row_select_users['date_of_birth'] != '') {
                $date_of_birth = explode('/', $row_select_users['date_of_birth']);
                $birth_date = $date_of_birth[0];
                $birth_month = $date_of_birth[1];
                $birth_year = $date_of_birth[2];

                $today = explode('/', date('d/m/Y'));
                $today_date = $today[0];
                $today_month = $today[1];
                $today_year = $today[2];

                if (($birth_date == '1') && ($birth_month != '1')) {
                    if ((in_array(number_format($today_date), ['29', '30', '31'])) && 
                        ((number_format($birth_month) - 1) == number_format($today_month))
                    ) {
                        $birthday_user_name = $row_select_users['user_name'];
                        $birthday_user_birthdate = $row_select_users['date_of_birth'];
                        $birthday_user_mobile = $row_select_users['user_mobile'];
                        $birthday_user_email = $row_select_users['user_email'];
                        $status = 'true';
                        
                        ?>
                        <div class="birthday-card">
                            <span class="birthday-text-red"><?php echo $birthday_user_name; ?></span>
                            <span><span class="uppercase">Birthday:</span> <?php echo $birthday_user_birthdate; ?></span>
                            <span><span class="uppercase">Mobile:</span> <?php echo $birthday_user_mobile; ?></span>
                            <span><span class="uppercase">Email:</span> <?php echo $birthday_user_email; ?></span>
                        </div>
                        <?php
                        // echo 'Upcoming birthday.';
                    }
                } else if (($birth_date == '1') && ($birth_month == '1')) {
                    if ((in_array(number_format($today_date), ['29', '30', '31'])) && 
                        ((number_format($today_month)) == number_format('12'))
                    ) {
                        $birthday_user_name = $row_select_users['user_name'];
                        $birthday_user_birthdate = $row_select_users['date_of_birth'];
                        $birthday_user_mobile = $row_select_users['user_mobile'];
                        $birthday_user_email = $row_select_users['user_email'];
                        $status = 'true';
                        
                        ?>
                        <div class="birthday-card">
                            <span class="birthday-text-red"><?php echo $birthday_user_name; ?></span>
                            <span><span class="uppercase">Birthday:</span> <?php echo $birthday_user_birthdate; ?></span>
                            <span><span class="uppercase">Mobile:</span> <?php echo $birthday_user_mobile; ?></span>
                            <span><span class="uppercase">Email:</span> <?php echo $birthday_user_email; ?></span>
                        </div>
                        <?php
                        // echo 'Upcoming birthday.';
                    }
                } else {
                    if (((number_format($birth_date) - 1) == number_format($today_date)) &&
                        (number_format($birth_month) == number_format($today_month))
                    ) {
                        $birthday_user_name = $row_select_users['user_name'];
                        $birthday_user_birthdate = $row_select_users['date_of_birth'];
                        $birthday_user_mobile = $row_select_users['user_mobile'];
                        $birthday_user_email = $row_select_users['user_email'];
                        $status = 'true';

                        ?>
                        <div class="birthday-card">
                            <span class="birthday-text-red"><?php echo $birthday_user_name; ?></span>
                            <span><span class="uppercase">Birthday:</span> <?php echo $birthday_user_birthdate; ?></span>
                            <span><span class="uppercase">Mobile:</span> <?php echo $birthday_user_mobile; ?></span>
                            <span><span class="uppercase">Email:</span> <?php echo $birthday_user_email; ?></span>
                        </div>
                        <?php
                        // echo 'Upcoming birthday.';
                    }
                }
            }
        }
        if ($status != 'true') {
            ?><div class="empty-box">No upcoming birthday.</div><?php
        } 
        ?>
    </div>

    <script src="../assets/js/birthday-alerts.js"></script>
</body>
</html>