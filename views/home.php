<h2 class="center" id="form-label">Update or Delete</h2>

<div class="v-form" id="signUpForm">
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

    <?php
    $userdata = $data['userdata'];
    ?>
    <form name="signUp" action="index.php?act=update" method="post" onsubmit="return validateForm()">
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

        <button class="btn btn-m" type="submit" value="Submit">Update</button>
    </form>
    <form action="index.php?act=delete" method="post">
        <input type="hidden" name="userId" value="<?php echo $userdata['id']; ?>">
        <button class="btn del_btn btn-m" type="submit" value="Submit">Delete Account</button>
    </form>
</div>