<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Manage Restaurants';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/manage-restaurants.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="manage-restaurants-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="manage-restaurants-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="manage-restaurants-search">
        <div class="search-input">
            <span><input type="text" placeholder="Search restaurant..." id="search-text"></span>
            <span class="search-button" onclick="searchRestaurant()">Search</span>
        </div>

        <div class="search-result">
        </div>
    </div>

    <?php
    if (isset($_GET['restaurantId']) && $_GET['restaurantId'] != '') {
        $sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$_GET["restaurantId"].'" ORDER BY id DESC';
    } else {
        $sql_select_restaurant = 'SELECT * FROM restaurant ORDER BY id DESC';
    }

    $result_select_restaurant = $conn->query($sql_select_restaurant);

    if ($result_select_restaurant->num_rows > 0) {
        while ($row_select_restaurant = $result_select_restaurant->fetch_assoc()) {
            $id = $row_select_restaurant['id'];
            $restaurant_id = $row_select_restaurant['restaurant_id'];
            $restaurant_status = $row_select_restaurant['restaurant_status'];
            $restaurant_name = $row_select_restaurant['name'];
            $restaurant_address = $row_select_restaurant['address'];
            $restaurant_rating = $row_select_restaurant['rating'];
            $restaurant_image = $row_select_restaurant['image'];
            $contact_persons_name = $row_select_restaurant['contact_persons_name'];
            $contact = $row_select_restaurant['contact'];            
            $pincode = $row_select_restaurant['pincode'];
            $email_id = $row_select_restaurant['email_id'];
            ?>
            <div class="your-restaurant-list">
                <div class="list-header">
                    <div class="header-block">
                        <span><?php echo $restaurant_name; ?></span>
                        <span>Restaurant ID: <?php echo $restaurant_id; ?></span>
                    </div>

                    <div class="header-block right">
                        <span>Rating</span>
                        <select id="restaurant-rating-<?php echo $id; ?>">
                            <option value="<?php echo $restaurant_rating; ?>" disabled selected><?php echo $restaurant_rating; ?></option>
                            <option value="" disabled>--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <span class="rating-button" id="rating-button-<?php echo $id; ?>" onclick="updateRating('<?php echo $id; ?>')">Update</span>
                    </div>
                </div>

                <div class="list-body">
                    
                    <div class="list-group">
                        <span>CONTACT PERSON'S NAME</span>
                        <span><?php echo $contact_persons_name; ?></span>
                    </div>

                    <div class="list-group">
                        <span>ADDRESS</span>
                        <span><?php echo $restaurant_address; ?></span>
                        <span><?php echo $pincode; ?></span>
                    </div>

                    <div class="list-group last">
                        <span>CONTACT</span>
                        <span><?php echo $contact; ?></span>
                        <span><?php echo $email_id; ?></span>
                    </div>
                </div>

                <div class="list-footer">
                    <div>
                        <span class="edit-button" onclick="editRestaurant('<?php echo $id; ?>')">Edit</span>
                        <span class="edit-button" onclick="openEditItems('<?php echo $id; ?>')">Edit Items</span>
                    </div>
                    
                    <div>
                    <?php
                
                    if (($row_select_restaurant['restaurant_status'] == 'true') && ($row_select_restaurant['restaurant_login_status'] == '')) {
                        ?>
                        <span class="default online-active">Online</span>
                        <?php
                    } else if (($row_select_restaurant['restaurant_status'] == 'true') && ($row_select_restaurant['restaurant_login_status'] == 'false')) {
                        ?>
                        <span class="default offline-active">Offline</span>
                        <?php
                    }

                    if ($restaurant_status == '') {
                        ?><span class="update-status-button" onclick="updateRestaurantStatus('<?php echo $id; ?>')">Approve</span><?php
                    } else {
                        ?><span class="update-status-button active">Approved</span><?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?><span class="empty-box">No restaurant found</span><?php
    }
    ?>

    <script src="../assets/js/manage-restaurants.js"></script>
</body>
</html>