<h2 class="center" id="form-label">SignUp</h2>

<div class="v-form" id="signUpForm">
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
    <form name="signUp" action="index.php?act=signUp" method="post" onsubmit="return validateForm()">
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

        <button class="btn-m" type="submit" value="Submit">SignUp</button>
    </form>
</div>