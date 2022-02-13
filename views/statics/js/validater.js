
function validateForm() {

    var fname = document.forms["signUp"]["fname"].value;
    var lname = document.forms["signUp"]["lname"].value;
    var username = document.forms["signUp"]["username"].value;
    var email = document.forms["signUp"]["email"].value;
    var phone = document.forms["signUp"]["phone"].value;
    var password = document.forms["signUp"]["password"].value;


    if (fname.length < 3) {
        document.getElementById("message").innerHTML = "First Name too short";
        document.getElementById("fname").focus();
        return false;
    } else if (lname.length < 3) {
        document.getElementById("message").innerHTML = "Last Name too short";
        document.getElementById("lname").focus();
        return false;
    } else if (username.length < 3) {
        document.getElementById("message").innerHTML = "User name Name too short";
        document.getElementById("username").focus()
        return false;
    } else if (!validateEmail(email)) {
        document.getElementById("message").innerHTML = "Please Enter Valid email";
        document.getElementById("email").focus()
        return false;
    } else if (!validatePhone(phone)) {
        document.getElementById("message").innerHTML = "Please Enter Valid 10 digit contact number";
        document.getElementById("phone").focus()
        return false;
    } else if (password.length < 8) {
        document.getElementById("message").innerHTML = "Password too short must be length length greater then 8";
        document.getElementById("password").focus()
        return false;
    }

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
