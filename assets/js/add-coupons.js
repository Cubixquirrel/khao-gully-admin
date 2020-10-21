function pageBack() {
    window.history.back();
}

function switchType(typeName, typeValue) {
    var input = document.querySelector('[name="'+typeName+'"]');
    input.value = typeValue;
    // var currentTypeBox = event.currentTarget;

    var switchBox = document.querySelectorAll('.switch-box.'+typeName+'');
    var currentSwitchBox = event.currentTarget;

    for (var i = 0; i < switchBox.length; i++) {
        switchBox[i].setAttribute('class', 'switch-box '+typeName+'');
    }

    currentSwitchBox.setAttribute('class', 'switch-box '+typeName+' active');
}

var couponCode = document.querySelector('#coupon-code');
var couponValue = document.querySelector('#value');
var minValue = document.querySelector('#min-value');
var description = document.querySelector('#description');
var addButton = document.querySelector('#add-button');
var allInput = document.querySelectorAll('input');
var allLabel = document.querySelectorAll('.label');

function enableButton(number) {
    if (number == '1') {
        if (
            (couponCode.value.length >= 6) && 
            (couponValue.value.length >= 1) && 
            (minValue.value.length >= 1) && 
            (description.value.length >= 1)
        ) {
            addButton.style.background = '#03a9f4';
            addButton.style.color = '#ffffff';
        } else {
            addButton.style.background = '#dddddd';
            addButton.style.color = '#999999';
        }
    }
}

function addCoupon() {
    addButton.value = 'Please Wait';
    addButton.setAttribute('disabled', 'disabled');
    addButton.style.background = '#dddddd';
    addButton.style.color = '#999999';

    if (
        (couponCode.value.length >= 6) && 
        (couponValue.value.length >= 1) && 
        (minValue.value.length >= 1) && 
        (description.value.length >= 1)
    ) {
        var couponExpiry = document.querySelector('[name="expiry"]');
        var couponType = document.querySelector('[name="type"]');

        for (var i = 0; i < allLabel.length; i++) {
            allLabel[i].style.color = '#0f0f0f';
        }

        var http = new XMLHttpRequest();
        var url = '../requests/add-coupon.php';
        var params = 
        'couponExpiry='+couponExpiry.value+
        '&couponType='+couponType.value+
        '&couponCode='+couponCode.value+
        '&couponValue='+couponValue.value+
        '&minValue='+minValue.value+
        '&description='+description.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText);
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        addButton.value = 'Added';
                        addButton.style.background = '#03a9f4';
                        addButton.style.color = '#ffffff';

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    } else {
        setTimeout(function() {
            addButton.value = 'Add';
            addButton.removeAttribute('disabled');

            if (couponCode.value.length < 6) {
                allLabel[0].style.color = '#FF5722';
            } else {
                allLabel[0].style.color = '#0f0f0f';
            }

            if (couponValue.value == '') {
                allLabel[1].style.color = '#FF5722';
            } else {
                allLabel[1].style.color = '#0f0f0f';
            }

            if (minValue.value == '') {
                allLabel[2].style.color = '#FF5722';
            } else {
                allLabel[2].style.color = '#0f0f0f';
            }

            if (description.value == '') {
                allLabel[3].style.color = '#FF5722';
            } else {
                allLabel[3].style.color = '#0f0f0f';
            }
        }, 1000);
    }
}