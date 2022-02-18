<?php include 'nav.php'; ?>

<h1 id="form-label" class="in-center">User List</h1>

<p class="notification" id="notice"></p>
<p class="notificationS" id="noticeS"></p>
<div class="container-fluid">
    <div class="modelUpdate" id="modelUpdate" hidden>
        <div>
            <div>
                <form name="userUpdateForm" id="userUpdateForm">
                    <input type="hidden" name="id" id="userId" value="">
                    <label class="label-space text-white" for="fname">First Name</label>
                    <input class="form-field-update" type="text" id="fname" name="firstname" value="" placeholder="Your name.." required>
                    <br>
                    <label class="label-space text-white" for="lname">Last Name</label>
                    <input class="form-field-update" type="text" id="lname" name="lastname" value="" placeholder="Your last name.." required>
                    <br>
                    <label class="label-space text-white " for="username">User Name</label>
                    <input class="form-field-update" type="text" id="username" name="username" value="" placeholder="Your user name.." required>
                    <br>
                    <label class="label-space text-white " for="email">Email</label>
                    <input class="form-field-update" type="email" id="email" name="email" value="" placeholder="Your email.." required>
                    <br>
                    <label class="label-space text-white " for="phone">Contact no.</label>
                    <input class="form-field-update" type="phone" id="phone" name="phone" value="" placeholder="Your contact number.." required>
                    <br>
                    <label class="label-space text-white" for="role">Role</label>
                    <select class="form-field-update" name="role" id="role" value="">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>

                    <div class="button-update">
                        <button class="btn btn-m" type="submit" value="Send">Update</button>
                    </div>

                </form>
                <div class="button-update">

                    <button class="btn-m del_btn button-update" onclick="document.getElementById('modelUpdate').style.display='none'">Close &times;</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>F-name</th>
                <th>L-name</th>
                <th>User-name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody id="rows">
            <?php
            $userdata = $data['userdata'];
            $index = 1;
            foreach ($userdata as $user) {

            ?>
                <tr>
                    <td><?php echo $index ?></td>
                    <td id="Rfname<?php echo $user['id']; ?>"><?php echo $user['fname']; ?></td>
                    <td id="Rlname<?php echo $user['id']; ?>"><?php echo $user['lname']; ?></td>
                    <td id="Rusername<?php echo $user['id']; ?>"><?php echo $user['username']; ?></td>
                    <td id="Remail<?php echo $user['id']; ?>"><?php echo $user['email']; ?></td>
                    <td id="Rcontact<?php echo $user['id']; ?>"><?php echo $user['contact']; ?></td>
                    <td id="Rrole<?php echo $user['id']; ?>"><?php echo $user['role']; ?></td>
                    <td>
                        <button id="<?php echo $user['id']; ?>" onclick="editData(<?php echo $user['id']; ?>)" class="btn edit_btn">
                            Edit</i>
                        </button>
                    </td>
                </tr>
            <?php $index++;
            } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>