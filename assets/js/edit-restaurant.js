function pageBack() {
    window.history.back();
}

function selectUpload(id) {
    document.querySelector('#'+id).click();
}

function validateUpload(id, restaurantId) {
    var upload = document.querySelector('#'+id);
    var uploadName = upload.getAttribute('name');

    if (upload.files.length === 0) {
    } else {
        upload.previousElementSibling.innerHTML = 'Uploading...';
        upload.previousElementSibling.removeAttribute('onclick');

        var http = new XMLHttpRequest();
        var formData = new FormData();
        formData.append(uploadName, upload.files[0]);
        formData.append('restaurantId', restaurantId);
        var url = '../requests/upload-restaurant-image.php';
        http.open('POST', url, true);
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {                
                // console.log(http.responseText);
                if(http.responseText != '') {
                    document.querySelector('#'+id+'-value').value = http.responseText;
                    setTimeout(function() {
                        upload.previousElementSibling.innerHTML = 'Uploaded';

                        setTimeout(() => {
                            upload.previousElementSibling.setAttribute('onclick', 'selectUpload("'+id+'", "'+restaurantId+'")');
                            upload.previousElementSibling.innerHTML = 'Re-upload';
                        }, 2000);
                    }, 2000);
                }
            }
        }
        http.send(formData);
    }
}

var editRestaurantForm = document.getElementById('edit-restaurant-form');
var outletName = document.querySelector('#outlet-name');
var outletAddress = document.querySelector('#outlet-address');
var pincode = document.querySelector('#pincode');
var contactPersonsName = document.querySelector('#contact-persons-name');
var emailId = document.querySelector('#email-id');
var mobileNumber = document.querySelector('#mobile-number');
var mainTag = document.querySelector('#main-tag');
var cuisines = document.querySelector('#cuisines');
var averagePricing = document.querySelector('#average-pricing');
var updateButton = document.querySelector('#update-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

var sunTiming1 = document.querySelector('#sun-timing-1');
var sunAmPm1 = document.querySelector('#sun-am-pm-1');
var sunTiming2 = document.querySelector('#sun-timing-2');
var sunAmPm2 = document.querySelector('#sun-am-pm-2');
var monTiming1 = document.querySelector('#mon-timing-1');
var monAmPm1 = document.querySelector('#mon-am-pm-1');
var monTiming2 = document.querySelector('#mon-timing-2');
var monAmPm2 = document.querySelector('#mon-am-pm-2');
var tueTiming1 = document.querySelector('#tue-timing-1');
var tueAmPm1 = document.querySelector('#tue-am-pm-1');
var tueTiming2 = document.querySelector('#tue-timing-2');
var tueAmPm2 = document.querySelector('#tue-am-pm-2');
var wedTiming1 = document.querySelector('#wed-timing-1');
var wedAmPm1 = document.querySelector('#wed-am-pm-1');
var wedTiming2 = document.querySelector('#wed-timing-2');
var wedAmPm2 = document.querySelector('#wed-am-pm-2');
var thuTiming1 = document.querySelector('#thu-timing-1');
var thuAmPm1 = document.querySelector('#thu-am-pm-1');
var thuTiming2 = document.querySelector('#thu-timing-2');
var thuAmPm2 = document.querySelector('#thu-am-pm-2');
var friTiming1 = document.querySelector('#fri-timing-1');
var friAmPm1 = document.querySelector('#fri-am-pm-1');
var friTiming2 = document.querySelector('#fri-timing-2');
var friAmPm2 = document.querySelector('#fri-am-pm-2');
var satTiming1 = document.querySelector('#sat-timing-1');
var satAmPm1 = document.querySelector('#sat-am-pm-1');
var satTiming2 = document.querySelector('#sat-timing-2');
var satAmPm2 = document.querySelector('#sat-am-pm-2');

function enableButton(number) {    
    if (number == '1') {
        if (
            (outletName.value.length >= 1) && 
            (outletAddress.value.length >= 1) && 
            (pincode.value.length == 6) && 
            (contactPersonsName.value.length >= 1) && 
            (emailId.value.length >= 1) && 
            (mobileNumber.value.length == 10) && 
            (mainTag.value.length >= 1) && 
            (cuisines.value.length >= 1) && 
            (averagePricing.value.length >= 1)
        ) {
            updateButton.style.background = '#03a9f4';
            updateButton.style.color = '#ffffff';
        } else {
            updateButton.style.background = '#dddddd';
            updateButton.style.color = '#999999';
        }
    }
}

function enableSaveChanges() {
    updateButton.style.background = '#03a9f4';
    updateButton.style.color = '#ffffff';
}

function updateRestaurant(restaurantId) {
    updateButton.value = 'Please Wait';
    updateButton.setAttribute('disabled', 'disabled');
    updateButton.style.background = '#dddddd';
    updateButton.style.color = '#999999';

    if (
        (outletName.value.length >= 1) && 
        (outletAddress.value.length >= 1) && 
        (pincode.value.length == 6) && 
        (contactPersonsName.value.length >= 1) && 
        (emailId.value.length >= 1) && 
        (mobileNumber.value.length == 10) && 
        (mainTag.value.length >= 1) && 
        (cuisines.value.length >= 1) && 
        (averagePricing.value.length >= 1)
    ) {
        for (var i = 0; i < allInput.length - 1; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/update-restaurant.php';
        var params = 
        'sunTiming1='+sunTiming1.value+
        '&sunAmPm1='+sunAmPm1.value+
        '&sunTiming2='+sunTiming2.value+
        '&sunAmPm2='+sunAmPm2.value+
        '&monTiming1='+monTiming1.value+
        '&monAmPm1='+monAmPm1.value+
        '&monTiming2='+monTiming2.value+
        '&monAmPm2='+monAmPm2.value+
        '&tueTiming1='+tueTiming1.value+
        '&tueAmPm1='+tueAmPm1.value+
        '&tueTiming2='+tueTiming2.value+
        '&tueAmPm2='+tueAmPm2.value+
        '&wedTiming1='+wedTiming1.value+
        '&wedAmPm1='+wedAmPm1.value+
        '&wedTiming2='+wedTiming2.value+
        '&wedAmPm2='+wedAmPm2.value+
        '&thuTiming1='+thuTiming1.value+
        '&thuAmPm1='+thuAmPm1.value+
        '&thuTiming2='+thuTiming2.value+
        '&thuAmPm2='+thuAmPm2.value+
        '&friTiming1='+friTiming1.value+
        '&friAmPm1='+friAmPm1.value+
        '&friTiming2='+friTiming2.value+
        '&friAmPm2='+friAmPm2.value+
        '&satTiming1='+satTiming1.value+
        '&satAmPm1='+satAmPm1.value+
        '&satTiming2='+satTiming2.value+
        '&satAmPm2='+satAmPm2.value+
        '&restaurantId='+restaurantId+
        '&outletName='+outletName.value+
        '&outletAddress='+outletAddress.value+
        '&pincode='+pincode.value+
        '&contactPersonsName='+contactPersonsName.value+
        '&emailId='+emailId.value+
        '&mobileNumber='+mobileNumber.value+
        '&mainTag='+mainTag.value+
        '&cuisines='+cuisines.value+
        '&averagePricing='+averagePricing.value
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

            if (outletName.value == '') {
                allLabel[0].style.color = '#FF5722';
            } else {
                allLabel[0].style.color = '#0f0f0f';
            }

            if (outletAddress.value == '') {
                allLabel[1].style.color = '#FF5722';
            } else {
                allLabel[1].style.color = '#0f0f0f';
            }

            if (pincode.value.length != 6) {
                allLabel[2].style.color = '#FF5722';
            } else {
                allLabel[2].style.color = '#0f0f0f';
            }

            if (contactPersonsName.value == '') {
                allLabel[3].style.color = '#FF5722';
            } else {
                allLabel[3].style.color = '#0f0f0f';
            }

            if (emailId.value == '') {
                allLabel[4].style.color = '#FF5722';
            } else {
                allLabel[4].style.color = '#0f0f0f';
            }

            if (mobileNumber.value.length != 10) {
                allLabel[5].style.color = '#FF5722';
            } else {
                allLabel[5].style.color = '#0f0f0f';
            }

            if (mainTag.value == '') {
                allLabel[6].style.color = '#FF5722';
            } else {
                allLabel[6].style.color = '#0f0f0f';
            }

            if (cuisines.value == '') {
                allLabel[7].style.color = '#FF5722';
            } else {
                allLabel[7].style.color = '#0f0f0f';
            }

            if (averagePricing.value == '') {
                allLabel[8].style.color = '#FF5722';
            } else {
                allLabel[8].style.color = '#0f0f0f';
            }
        }, 1000);
    }
}