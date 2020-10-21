function pageBack() {
    window.history.back();
}

function openEditCoupon(couponId) {
    window.location.href = '../views/edit-coupon.php?couponId='+couponId;
}