<?php
class UserModel
{

    function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'lss');
        //$this->conn = new mysqli('sql102.epizy.com', 'epiz_31074911', 'yCZ12Xr0Rs', 'epiz_31074911_XXX');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function checkRole($email)
    {
        $sql = "SELECT * FROM `user` WHERE `email` = '" . $email . "' AND `role` = 'admin'";
        if (mysqli_num_rows($this->conn->query($sql)) == 1) {
            return "admin";
        } else {
            return "user";
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `user` WHERE `user`.`id` = $id";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM `user` WHERE `email` = '" . $email . "'";
        if ($this->conn->query($sql) == true) {
            $result = mysqli_query($this->conn, $sql);
        }

        return $result;
    }

    public function getEmail($id)
    {
        $sql =  "SELECT * FROM `user` WHERE `user`.`id` = $id";
        if ($this->conn->query($sql) == true) {
            $result = mysqli_query($this->conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    return $row["email"];
                }
            }
        }
        return $result;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM `user`";
        if ($this->conn->query($sql) == true) {
            $result = mysqli_query($this->conn, $sql);
        }

        return $result;
    }

    public function update($array, $id)
    {
        $sql = "UPDATE `user` SET `fname` = '$array[0]', `lname` = '$array[1]', `username` = '$array[2]', `email` = '$array[3]', `contact` = '$array[4]', `password` = '$array[5]' WHERE `user`.`id` = $id";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }


    public function adminUpdate($array, $id)
    {
        $sql = "UPDATE `user` SET `fname` = '$array[0]', `lname` = '$array[1]', `username` = '$array[2]', `email` = '$array[3]', `contact` = '$array[4]', `role` = '$array[5]' WHERE `user`.`id` = $id";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {

        $sql = "SELECT `email` FROM `user` WHERE `email` = '" . $email . "' and `password` = '" . $password . "'";


        if (mysqli_num_rows($this->conn->query($sql))) {
            return true;
        } else {
            return false;
        }
    }


    public function signUp($array)
    {
        $sql = "INSERT INTO `user`( `fname`, `lname`, `username`, `email`, `contact`, `password`, `role` ) VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]', '$array[6]');";
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function alreadyExist($email, $for = "")
    {
        $sql = "SELECT `email` FROM `user` WHERE `email` = '" . $email . "'";
        if ($for == "forUpdate") {
            if (mysqli_num_rows($this->conn->query($sql)) == 1) {
                return true;
            } else {
                return false;
            }
        } else {

            if (mysqli_num_rows($this->conn->query($sql))) {
                return true;
            } else {
                return false;
            }
        }
    }
}
