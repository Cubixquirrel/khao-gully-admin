function pageBack() {
    window.history.back();
}

var editDriverForm = document.getElementById('edit-driver-form');
var driverName = document.querySelector('#driver-name');
var driverAddress = document.querySelector('#driver-address');
var pincode = document.querySelector('#pincode');
var emailId = document.querySelector('#email-id');
var mobileNumber = document.querySelector('#mobile-number');
var updateButton = document.querySelector('#update-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

function enableButton(number) {    
    if (number == '1') {
        if (
            (driverName.value.length >= 1) && 
            (driverAddress.value.length >= 1) && 
            (pincode.value.length == 6) && 
            (emailId.value.length >= 1) && 
            (mobileNumber.value.length == 10)
        ) {
            updateButton.style.background = '#03a9f4';
            updateButton.style.color = '#ffffff';
        } else {
            updateButton.style.background = '#dddddd';
            updateButton.style.color = '#999999';
        }
    }
}

function updateDriver(driverId) {
    updateButton.value = 'Please Wait';
    updateButton.setAttribute('disabled', 'disabled');
    updateButton.style.background = '#dddddd';
    updateButton.style.color = '#999999';

    if (
        (driverName.value.length >= 1) && 
        (driverAddress.value.length >= 1) && 
        (pincode.value.length == 6) && 
        (emailId.value.length >= 1) && 
        (mobileNumber.value.length == 10)
    ) {
        for (var i = 0; i < allInput.length - 1; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/update-driver.php';
        var params = 
        'driverId='+driverId+
        '&driverName='+driverName.value+
        '&driverAddress='+driverAddress.value+
        '&pincode='+pincode.value+
        '&emailId='+emailId.value+
        '&mobileNumber='+mobileNumber.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText)
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        updateButton.value = 'Updated';
                        updateButton.style.background = '#03a9f4';
                        updateButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.history.back();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            updateButton.value = 'Update';
            updateButton.removeAttribute('disabled');

            if (driverName.value == '') {
                allLabel[0].style.color = '#FF5722';
            } else {
                allLabel[0].style.color = '#0f0f0f';
            }

            if (driverAddress.value == '') {
                allLabel[1].style.color = '#FF5722';
            } else {
                allLabel[1].style.color = '#0f0f0f';
            }

            if (pincode.value.length != 6) {
                allLabel[2].style.color = '#FF5722';
            } else {
                allLabel[2].style.color = '#0f0f0f';
            }

            if (emailId.value == '') {
                allLabel[3].style.color = '#FF5722';
            } else {
                allLabel[3].style.color = '#0f0f0f';
            }

            if (mobileNumber.value.length != 10) {
                allLabel[4].style.color = '#FF5722';
            } else {
                allLabel[4].style.color = '#0f0f0f';
            }
        }, 1000);
    }
}