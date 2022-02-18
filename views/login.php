<?php include 'nav.php'; ?>
<h2 id="form-label" class="center"><?php if (isset($data['page'])) {
                                        echo ($data['page'] == "signUp") ? "SignUp" : "Login";
                                    } ?></h2>
<p class="notification" id="notice"></p>
<p class="notificationS" id="noticeS"></p>
<div class="v-form" id="loginForm" <?php if (isset($data['page'])) {
                                        echo ($data['page'] == "signUp") ? "hidden" : "";
                                    } ?>>
    <p class="text-success"><?php
                            if (isset($data['msg'])) {
                                echo $data['msg'];
                            } ?>
    </p>
    <p class="text-danger"><?php
                            if (isset($data['msgS'])) {
                                echo $data['msgS'];
                            } ?>
    </p>
    <form id="login" action="login" method="post">

        <label for="email">Email</label>
        <input class="form-field" type="email" id="email" name="email" placeholder="Email">

        <label for="password">Password</label>
        <input class="form-field" type="password" id="password" name="password" placeholder="Password">

        <button class="btn-m" type="submit" value="Submit">Login</button>
    </form>
</div>

<div class="v-form" id="signUpForm" <?php if (isset($data['page'])) {
                                        echo ($data['page'] == "signUp") ? "" : "hidden";
                                    } ?>>
    <p class="text-danger" id="message"><?php
                                        if (isset($data['msg'])) {
                                            echo $data['msg'];
                                        } ?>
    </p>
    <?php
    if (isset($data['userData'])) {
        $userdata = $data['userData'];
    }
    ?>
    <form name="signUp" action="signUp" method="post" onsubmit="return validateSignUpForm()">
        <label for="fname">First Name</label>
        <input class="form-field" type="text" id="fname" name="firstname" value="<?php echo isset($userdata) ? $userdata[0] : ""; ?>" placeholder="Your name.." required>

        <label for="lname">Last Name</label>
        <input class="form-field" type="text" id="lname" name="lastname" value="<?php echo isset($userdata) ? $userdata[1] : ""; ?>" placeholder="Your last name.." required>

        <label for="username">User Name</label>
        <input class="form-field" type="text" id="username" name="username" value="<?php echo isset($userdata) ? $userdata[2] : ""; ?>" placeholder="Your user name.." required>

        <label for="email">Email</label>
        <input class="form-field" type="email" id="email" name="email" value="<?php echo isset($userdata) ? $userdata[3] : ""; ?>" placeholder="Your email.." required>

        <label for="phone">Contact no.</label>
        <input class="form-field" type="phone" id="phone" name="phone" value="<?php echo isset($userdata) ? $userdata[4] : ""; ?>" placeholder="Your contact number with country code.." required>

        <label for="password">Password</label>
        <input class="form-field" type="password" id="password" name="password" value="<?php echo isset($userdata) ? $userdata[5] : ""; ?>" placeholder="Your password.." required>

        <label for="role">Register as:</label>
        <select class="form-field" name="role" id="role">
            <?php echo isset($userdata) ? $userdata[6] : ""; ?>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="btn-m" type="submit" value="Submit">SignUp</button>
    </form>
</div>



<?php include 'footer.php'; ?>