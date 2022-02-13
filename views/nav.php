<!DOCTYPE html>
<html>

<head>
    <title><?php
            echo $data['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="http://localhost/LSS/views/statics/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://localhost/LSS/views/statics/js/validater.js"></script>
</head>

<body class="one-page">
    <ul class="broad-line">
        <li><a class="active" href="index.php">Home</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
            <li><a href="index.php?act=logout">Logout</a></li>
        <?php
        } else { ?>
            <li><a href="index.php?act=signUp">SignUp</a></li>
            <li><a href="index.php?act=login">Login</a></li>

        <?php
        } ?>

    </ul>