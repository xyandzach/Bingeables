function createUser() {
    var email = document.getElementById("email").value;
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    //create new request
    var http = new XMLHttpRequest();

    //callback function definition
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if ("true") {
                window.location.href = "homepage.html";
            } else {
                alert("Account creation failed. Please try later.");
            }
        }
    };

    //open request as POST to login.php
    http.open("POST", "php/login.php", true);

    //set data format to header
    //todo: convert to JSON
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    //send user and pass data using ^ format
    http.send("email=" + email + "&password=" + pass + "&user= " + user);
}