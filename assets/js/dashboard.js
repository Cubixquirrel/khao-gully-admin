function openEditItems() {
    window.location.href = '../views/edit-items.php';
}

function openAllOrders() {
    window.location.href = '../views/all-orders.php';
}

function openManageRestaurants() {
    window.location.href = '../views/manage-restaurants.php';
}

function openManageDrivers() {
    window.location.href = '../views/manage-drivers.php';
}

function openAddCoupons() {
    window.location.href = '../views/add-coupons.php';
}

function openManageCoupons() {
    window.location.href = '../views/manage-coupons.php';
}

function openReports() {
    window.location.href = '../views/reports.php';
}

function openUploadBanners() {
    window.location.href = '../views/upload-banners.php';
}

function openBirthdayAlerts() {
    window.location.href = '../views/birthday-alerts.php';
}

function logout() {
    var http = new XMLHttpRequest();
    var url = '../requests/logout.php';
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            window.location.href = '../views/login.php';
        }
    }
    http.send();
}