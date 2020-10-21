function pageBack() {
    window.history.back();
}

function editDriver(id) {
    var currentEditButton = event.currentTarget;
    currentEditButton.style.background = '#dddddd';
    currentEditButton.style.color = '#999999';
    currentEditButton.style.border = '1px solid #dddddd';

    setTimeout(() => {
        window.location.href = '../views/edit-driver.php?id='+id;        
    }, 300);
}

function updateDriverStatus(driverId) {
    var updateStatusButton = event.currentTarget;

    updateStatusButton.innerHTML = 'Please Wait';
    updateStatusButton.removeAttribute('onclick');

    var http = new XMLHttpRequest();
    var url = '../requests/update-driver-status.php';
    var params = 
    'driverId='+driverId
    ;

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            // console.log(http.responseText);
            if(http.responseText == 'true') {
                setTimeout(function() {
                    updateStatusButton.innerHTML = 'Approved';
                    updateStatusButton.setAttribute('class', 'update-status-button active');
                }, 2000);
            }
        }
    }
    http.send(params);
}