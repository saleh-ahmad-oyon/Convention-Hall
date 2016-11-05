//AJAX Code to check Email field values when onblur event triggerd.
function validateEmail(field, query) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = xmlhttp.responseText;
            if(xmlhttp.responseText != ''){
                //adding class .has-error
                var id = 'emailVal';
                var myClassName = "has-error";
                var d=document.getElementById(id);
                d.className=d.className.replace(myClassName,"");
                d.className = d.className + ' ' + myClassName;
                document.getElementById('email1').focus();
            }
        }
        else {
            document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
        }
    };
    /*xmlhttp.open("POST", "controller/checkDuplicateEmail.php", true);
     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xmlhttp.send("query=" + query);*/

    xmlhttp.open("GET", "controller/checkDuplicateEmail.php?query=" + query, false);
    xmlhttp.send();
}

//AJAX Code to check old password field values when onblur event triggerd.
function validatePassword(field, query) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {
        // for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = xmlhttp.responseText;
            if(xmlhttp.responseText != ''){
                document.getElementById('oldPass1').focus();
            }
        } else {
            document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
        }
    };

    xmlhttp.open("POST", "controller/checkOldPass.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("query=" + query);
}

//check date and shift if it's valid when onblur event triggerd.
function shiftvalidate(field, query)
{
    var date1   = document.getElementById('datepicker').value  ;
    var xmlhttp = '';

    if (window.XMLHttpRequest) {
        // for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(field).innerHTML = xmlhttp.responseText;
            if (xmlhttp.responseText != '') {
                document.getElementById('shift').value = '';
            }
        } else {
            document.getElementById(field).innerHTML = "Error Occurred. <a href='booking.php'>Reload Or Try Again</a> the page.";
        }
    };
    xmlhttp.open("GET", "controller/checkDuplicateShift.php?query=" + query + "&date=" + date1, false);
    xmlhttp.send();
}
