
function notify(message) {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    document.getElementById("notice").innerHTML = message;
    $(".notification").show();
    $(".notification").fadeOut(3000, 0);
    return;
}

function notifyS(message) {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    document.getElementById("noticeS").innerHTML = message;
    $(".notificationS").show();
    $(".notificationS").fadeOut(3000, 0);
    return;
}

function validateSignUpForm() {

    var fname = document.forms["signUp"]["fname"].value;
    var lname = document.forms["signUp"]["lname"].value;
    var username = document.forms["signUp"]["username"].value;
    var email = document.forms["signUp"]["email"].value;
    var phone = document.forms["signUp"]["phone"].value;
    var password = document.forms["signUp"]["password"].value;


    if (fname.length < 3) {
        notify("First Name too short");
        document.getElementById("fname").focus();
        return false;
    } else if (lname.length < 3) {
        notify("Last Name too short");
        document.getElementById("lname").focus();
        return false;
    } else if (username.length < 3) {
        notify("User name Name too short");
        document.getElementById("username").focus()
        return false;
    } else if (!validateEmail(email)) {
        notify("Please Enter Valid email");
        document.getElementById("email").focus()
        return false;
    } else if (!validatePhone(phone)) {
        notify("Please Enter Valid 10 digit contact number");
        document.getElementById("phone").focus()
        return false;
    } else if (password.length < 8) {
        notify("Password too short must be length length greater then 8");
        document.getElementById("password").focus()
        return false;
    }

    return true;

}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validatePhone(phoneNumber) {
    var re = /^\+(?:[0-9] ?){6,14}[0-9]$/;
    return re.test(phoneNumber);
}
// $(document).ready(function () {
//     $("#signUp").on("submit", function (e) {
//         var dataString = $(this).serialize();
//         console.log("sf");
//         $.ajax({
//             type: "POST",
//             url: "index.ph",
//             data: dataString,
//             dataType: "json",
//             success: function (data) {
//                 console.log("calling");
//                 console.log(data);
//                 $('html, body').animate({ scrollTop: 0 }, 'fast');
//             }
//         });
//         e.preventDefault();

//     });
// });
