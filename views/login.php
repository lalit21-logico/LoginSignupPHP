<h2 class="center">Login</h2>

<div class="v-form" id="loginForm">
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
    <form id="login" action="index.php?act=login" method="post">

        <label for="email">Email</label>
        <input class="form-field" type="email" id="email" name="email" placeholder="Email">

        <label for="password">Password</label>
        <input class="form-field" type="password" id="password" name="password" placeholder="Password">

        <button class="btn-m" type="submit" value="Submit">Login</button>
    </form>
</div>