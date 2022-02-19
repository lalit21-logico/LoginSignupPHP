// $(document).ready(function () {
//     console.log("sf");
//     $.ajax({
//         type: "GET",
//         url: "index.php?act=ajaxHome",
//         dataType: "json",
//         success: function (data) {
//             console.log("calling");
//             $('html, body').animate({ scrollTop: 0 }, 'fast');
//             if (data.is_login) {

//             } else {
//             }
//         }
//     });
// });



$(document).ready(function () {
    $("#updateForm").on("submit", function (e) {
        var dataString = $(this).serialize();
        console.log("sdd");
        if (validateForm()) {
            $.ajax({
                type: "POST",
                url: "index.php?act=update",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    console.log("calling");
                    document.getElementById("title").innerHTML = "Home";
                    window.history.pushState({}, "Home", "")
                    if (data.is_update) {
                        console.log("updated");
                        notifyS("Upadted");
                    } else {
                        notify("Email already exsist");
                    }
                }
            });
        }
        e.preventDefault();

    });
});



$(document).ready(function () {
    $("#userUpdateForm").on("submit", function (e) {
        var dataString = $(this).serialize();
        console.log("sdd");
        if (validateAdminForm()) {
            $.ajax({
                type: "POST",
                url: "index.php?act=adminUpdate",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    console.log("Admin calling");
                    if (data.is_update == "logout") {
                        notify("sorry you logged out");
                    } else if (data.is_update == "selfUser") {
                        notifyS("Your Role is now as user");
                    }
                    else if (data.is_update) {
                        console.log("updated");
                        notifyS("User Upadted");
                    } else {
                        notify("Email already exsist");
                    }
                    setTimeout(function () {
                        //alert('Reloading Page');
                        location.reload();
                    }, 2000);
                },
                failure: function (response) {
                    alert("sdfjsdjf2222");
                    console.log(response.responseText);
                },
                error: function (error) {
                    console.log(error);
                    // console.log(response.responseText);
                }
            });
        }
        e.preventDefault();

    });
});


function editData(id) {
    console.log(id);
    document.getElementById('modelUpdate').style.display = 'none';
    document.getElementById('modelUpdate').style.display = 'block';
    var Rfname = document.getElementById('Rfname' + id).innerHTML;
    var Rlname = document.getElementById('Rlname' + id).innerHTML;
    var Rusername = document.getElementById('Rusername' + id).innerHTML;
    var Remail = document.getElementById('Remail' + id).innerHTML;
    var Rcontact = document.getElementById('Rcontact' + id).innerHTML;
    var Rrole = document.getElementById('Rrole' + id).innerHTML;

    document.getElementById('userId').value = id;
    document.getElementById('fname').value = Rfname;
    document.getElementById('lname').value = Rlname;
    document.getElementById('username').value = Rusername;
    document.getElementById('email').value = Remail;
    document.getElementById('phone').value = Rcontact;
    document.getElementById('role').value = Rrole;
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    // document.getElementById("msg").innerHTML = "Update Now";
}

function deleteUser(id) {
    var dataString = "userId=" + id;
    console.log(dataString);
    var result = confirm("Want to delete?");
    console.log("delete");
    if (result) {
        $.ajax({
            type: "POST",
            url: "index.php?act=adminDelete",
            data: dataString,
            dataType: "json",
            success: function (data) {
                console.log("deleted");
                notify("User Account Deleted");
                setTimeout(function () {
                    //alert('Reloading Page');
                    location.reload();
                }, 2000);
            }
        });
    }
}

function deleteData(id) {
    var dataString = "userId=" + id;
    console.log(dataString);
    var result = confirm("Want to delete?");
    console.log("delete");
    if (result) {
        $.ajax({
            type: "POST",
            url: "index.php?act=delete",
            data: dataString,
            dataType: "json",
            success: function (data) {
                console.log("deleted");
                document.getElementById("title").innerHTML = "Login";
                window.history.pushState({}, "Login", "Login")
                notify("User Account Deleted");
                getLogin();

            }
        });
    }
}

function logout() {
    console.log("getData")
    $.ajax({
        type: "GET",
        url: "index.php?act=logout",
        dataType: "json",
        success: function (data) {
            console.log("getData");
            document.getElementById("title").innerHTML = "Login";
            window.history.pushState({}, "Login", "login")
            notify("Loged out to access account Login");
            getLogin();
        }
    });
}

function signUpPage() {
    console.log("signUpPage");
    document.getElementById("form-label").innerHTML = "SignUp";
    document.getElementById("title").innerHTML = "SignUp";
    window.history.pushState({}, "SignUp", "signUp")
    $("#signUpForm").show();
    $("#loginForm").hide();
}

function loginPage() {
    document.getElementById("form-label").innerHTML = "Login";
    document.getElementById("title").innerHTML = "Login";
    window.history.pushState({}, "Login", "login")
    $("#signUpForm").hide();
    $("#loginForm").show();

}

function getLogin() {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    var menu = '<li><a class="active" href="index.php">Home</a></li>';
    menu += '<li><a onclick="signUpPage()">SignUp</a></li>';
    menu += '<li><a onclick="loginPage()">Login</a></li>';

    $("#signUpForm1").hide();
    document.getElementById("form-label").innerHTML = "Login";
    $("#loginForm").show();
    document.getElementById("menu").innerHTML = menu;
    console.log("logOut");

}



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

function validateForm() {

    var fname = document.forms["updateForm"]["fname"].value;
    var lname = document.forms["updateForm"]["lname"].value;
    var username = document.forms["updateForm"]["username"].value;
    var email = document.forms["updateForm"]["email"].value;
    var phone = document.forms["updateForm"]["phone"].value;
    var password = document.forms["updateForm"]["password"].value;


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


function validateAdminForm() {

    var fname = document.forms["userUpdateForm"]["fname"].value;
    var lname = document.forms["userUpdateForm"]["lname"].value;
    var username = document.forms["userUpdateForm"]["username"].value;
    var email = document.forms["userUpdateForm"]["email"].value;
    var phone = document.forms["userUpdateForm"]["phone"].value;
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
