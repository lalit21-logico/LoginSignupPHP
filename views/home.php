<?php include 'nav.php'; ?>
<h2 class="center" id="form-label">Update or Delete</h2>
<p class="notification" id="notice"></p>
<p class="notificationS" id="noticeS"></p>
<div class="v-form" id="signUpForm1">
    <p class="text-success"><?php
                            if (isset($data['msg'])) {
                                echo $data['msg'];
                            } ?>
    </p>
    <p class="text-danger" id="message"><?php
                                        if (isset($data['msgS'])) {
                                            echo $data['msgS'];
                                        } ?>
    </p>


    <?php
    $userdata = $data['userdata'];
    ?>
    <form name="updateForm" id="updateForm">
        <input type="hidden" name="id" value="<?php echo $userdata['id']; ?>">
        <label class="label-space" for="fname">First Name</label>
        <input class="form-field-update" type="text" id="fname" name="firstname" value="<?php echo $userdata['fname']; ?>" placeholder="Your name.." required>
        <br>

        <label class="label-space" for="lname">Last Name</label>
        <input class="form-field-update" type="text" id="lname" name="lastname" value="<?php echo $userdata['lname']; ?>" placeholder="Your last name.." required>
        <br>
        <label class="label-space" for="username">User Name</label>
        <input class="form-field-update" type="text" id="username" name="username" value="<?php echo $userdata['username']; ?>" placeholder="Your user name.." required>
        <br>
        <label class="label-space" for="email">Email</label>
        <input class="form-field-update" type="email" id="email" name="email" value="<?php echo $userdata['email']; ?>" placeholder="Your email.." required>
        <br>
        <label class="label-space" for="phone">Contact no.</label>
        <input class="form-field-update" type="phone" id="phone" name="phone" value="<?php echo $userdata['contact']; ?>" placeholder="Your contact number.." required>
        <br>
        <label class="label-space" for="password">Password</label>
        <input class="form-field-update" type="password" id="password" name="password" value="<?php echo $userdata['password']; ?>" placeholder="Your password.." required>

        <button class="btn btn-m" type="submit" value="Send">Update</button>
    </form>
    <!-- <form action="index.php?act=delete" method="post">
        <input type="hidden" name="userId" value="<?php //echo $userdata['id']; 
                                                    ?>">
        <button class="btn del_btn btn-m" type="submit" value="Submit">Delete Account</button>
    </form> -->
    <button onclick="deleteData(<?php echo $userdata['id']; ?>)" class="btn del_btn btn-m">
        Delete Account
    </button>
</div>

<div class="v-form" id="loginForm" hidden>
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

<div class="v-form" id="signUpForm" hidden>
    <p class="text-danger" id="message">
    </p>

    <form name="signUp" action="signUp" method="post" onsubmit="return validateSignUpForm()">
        <label for="fname">First Name</label>
        <input class="form-field" type="text" id="fname" name="firstname" value="" placeholder="Your name.." required>

        <label for="lname">Last Name</label>
        <input class="form-field" type="text" id="lname" name="lastname" value="" placeholder="Your last name.." required>

        <label for="username">User Name</label>
        <input class="form-field" type="text" id="username" name="username" value="" placeholder="Your user name.." required>

        <label for="email">Email</label>
        <input class="form-field" type="email" id="email" name="email" value="" placeholder="Your email.." required>

        <label for="phone">Contact no.</label>
        <input class="form-field" type="phone" id="phone" name="phone" value="" placeholder="Your contact number with country code.." required>

        <label for="password">Password</label>
        <input class="form-field" type="password" id="password" name="password" value="" placeholder="Your password.." required>

        <label for="role">Register as:</label>
        <select class="form-field" name="role" id="role" value="<?php echo isset($userdata) ? $userdata[6] : ""; ?>">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="btn-m" type="submit" value="Submit">SignUp</button>
    </form>
</div>

<?php include 'footer.php'; ?>