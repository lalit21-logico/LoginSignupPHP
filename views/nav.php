<!DOCTYPE html>
<html>

<head>
    <title id="title"><?php
                        echo $data['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="http://localhost/LSS/views/statics/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../LSS/views/statics/js/validater.js"></script>
    <script src="../LSS/views/statics/js/ajax_post.js"></script>
</head>

<body class="one-page">
    <ul class="broad-line" id="menu">
        <!-- <li><a class="active" href="index.php">Home</a></li> -->
        <li><a class="active" href="index.php">Home</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
            <li><a onclick="logout()">Logout</a></li>
            <!-- <button onclick="logout()" class="btn edit_btn">
                Logout</button> -->
        <?php
        } else { ?>
            <!-- <li><a href="index.php?act=signUp">SignUp</a></li>
            <li><a href="index.php?act=login">Login</a></li> -->
            <li><a onclick="signUpPage()">SignUp</a></li>
            <li><a onclick="loginPage()">Login</a></li>

        <?php
        } ?>


    </ul>