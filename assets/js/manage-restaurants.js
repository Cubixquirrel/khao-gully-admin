function pageBack() {
    window.history.back();
}

function searchRestaurant() {
    var searchText = document.querySelector('#search-text');

    if (searchText.value != '') {
        var searchButton = document.querySelector('.search-button');
        var searchResult = document.querySelector('.search-result');
        searchButton.innerHTML = 'Searching...';
        searchButton.removeAttribute('onclick');
        searchResult.style.display = 'none';
        searchResult.innerHTML = '';

        var http = new XMLHttpRequest();
        var url = '../requests/search-restaurant.php';
        var params = 
        'restaurantName='+searchText.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText);
                setTimeout(() => {
                    searchButton.innerHTML = 'Search';
                    searchButton.setAttribute('onclick', 'searchRestaurant()');

                    if(http.responseText != 'false') {                        
                        var responses = http.responseText.split('__%__');
                        
                        responses.forEach(element => {
                            if (element != '') {
                                var response = element.split('_%_');
                                var restaurantId = response[0];
                                var restaurantName = response[1];
    
                                var li = document.createElement('li');
                                li.setAttribute('onclick', 'openRestaurant("'+restaurantId+'")');
                                li.innerHTML = restaurantName;
                                searchResult.appendChild(li);
                            }
                        });
                    } else {
                        var li = document.createElement('li');
                        li.innerHTML = 'No result found.';
                        searchResult.appendChild(li);
                    }
    
                    searchResult.style.display = 'block';
                }, 2000);
            }
        }
        http.send(params);
    }
}

function openRestaurant(restaurantId) {
    window.location.href = '../views/manage-restaurants.php?restaurantId='+restaurantId;
}

function openEditItems(restaurantId) {
    window.location.href = '../views/edit-items.php?restaurantId='+restaurantId;
}

function editRestaurant(id) {
    var currentEditButton = event.currentTarget;
    currentEditButton.style.background = '#dddddd';
    currentEditButton.style.color = '#999999';
    currentEditButton.style.border = '1px solid #dddddd';

    setTimeout(() => {
        window.location.href = '../views/edit-restaurant.php?id='+id;        
    }, 300);
}

function updateRating(restaurantId) {
    var ratingButton = document.querySelector('#rating-button-'+restaurantId);
    var restaurantRating = document.querySelector('#restaurant-rating-'+restaurantId);

    if (restaurantRating.value != '') {
        ratingButton.innerHTML = 'Updating';
        ratingButton.removeAttribute('onclick');

        var http = new XMLHttpRequest();
        var url = '../requests/update-restaurant-rating.php';
        var params = 
        'restaurantId='+restaurantId+
        '&rating='+restaurantRating.value
        ;

        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText);
                if(http.responseText == 'true') {
                    setTimeout(function() {
                        ratingButton.innerHTML = 'Updated';
                        
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }, 2000);
                }
            }
        }
        http.send(params);
    }
}

function updateRestaurantStatus(restaurantId) {
    var updateStatusButton = event.currentTarget;

    updateStatusButton.innerHTML = 'Please Wait';
    updateStatusButton.removeAttribute('onclick');

    var http = new XMLHttpRequest();
    var url = '../requests/update-restaurant-status.php';
    var params = 
    'restaurantId='+restaurantId
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