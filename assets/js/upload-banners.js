function pageBack() {
    window.history.back();
}

function selectUpload(id) {
    document.querySelector('#'+id).click();
}

function validateUpload(id) {
    var upload = document.querySelector('#'+id);
    var uploadName = upload.getAttribute('name');

    if (upload.files.length === 0) {
    } else {
        upload.previousElementSibling.innerHTML = 'Uploading...';
        upload.previousElementSibling.removeAttribute('onclick');

        var http = new XMLHttpRequest();
        var formData = new FormData();
        formData.append(uploadName, upload.files[0]);
        var url = '../requests/upload-banner.php';
        http.open('POST', url, true);
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {                
                // console.log(http.responseText);
                if(http.responseText != '') {
                    document.querySelector('#'+id+'-value').value = http.responseText;
                    setTimeout(function() {
                        upload.previousElementSibling.innerHTML = 'Uploaded';

                        setTimeout(() => {
                            upload.previousElementSibling.setAttribute('onclick', 'selectUpload("'+id+'")');
                            upload.previousElementSibling.innerHTML = 'Re-upload';
                        }, 2000);
                    }, 2000);
                }
            }
        }
        http.send(formData);
    }
}