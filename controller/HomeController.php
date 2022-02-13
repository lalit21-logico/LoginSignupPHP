<?php
require_once "controller.php";
require 'models/UserModel.php';

class HomeController extends Controller
{
    public function __construct()
    {
        $this->UserModel =  new UserModel();
    }

    public function index()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : "a";
        switch ($act) {
            case 'signUp':
                $this->signUp();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->home();
                break;
        }
    }

    public function home($msg = "", $msgs = "")
    {
        if (!isset($_SESSION['loggedin'])) {
            return $this->login($msg);
        }
        $result = $this->UserModel->getUser($_SESSION['useremail']);

        foreach ($result->fetch_all(MYSQLI_ASSOC) as $d) {
            $data['userdata'] = $d;
        }
        $data['title'] = 'Home page';
        $data['msg'] = $msg;
        $data['msgS'] = $msgs;
        $this->view('nav', $data);
        $this->view('home', $data);
        $this->view('footer');
    }

    public function delete()
    {
        if (true == isset($_POST['userId'])) {
            $id = trim($_POST["userId"]);
            $this->UserModel->delete($id);
            unset($_SESSION['loggedin']);
            unset($_SESSION['useremail']);
            $msg = "User deleted";
            return $this->home($msg);
        }
    }

    public function update()
    {

        if (true == isset($_POST['firstname'])) {
            $id = trim($_POST["id"]);
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $password = trim($_POST["password"]);
            $userdata = array(
                $firstname,
                $lastname,
                $username,
                $email,
                $phone,
                $password,
            );

            if ($_SESSION['useremail'] != $email  and $this->UserModel->alreadyExist($email, "forUpdate")) {
                $msgs = 'email already exisist';
                return $this->home("", $msgs);
            }
            $_SESSION['useremail'] = $email;
            $this->UserModel->update($userdata, $id);
            $msg = 'updated success';
            return $this->home($msg);
        }
    }

    public function logout()
    {
        $_SESSION['loggedin'] = false;
        $_SESSION['useremail'] = "";
        unset($_SESSION['loggedin']);
        unset($_SESSION['useremail']);
        $data['title'] = 'Login';
        $this->view('nav', $data);
        $this->view('login', $data);
        $this->view('footer');
    }


    public function login($msg = "")
    {
        if (true == isset($_POST['email'])) {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            if ($this->UserModel->login($email, $password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email;
                return $this->home();
            } else {
                $data['msgS'] = 'email or password is incorrect';
            }
        }
        $data['title'] = 'Login';
        $data['msgS'] = $msg;
        $this->view('nav', $data);
        $this->view('login', $data);
        $this->view('footer');
    }

    public function signUp()
    {
        if (true == isset($_POST['firstname'])) {
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $password = trim($_POST["password"]);
            $userdata = array(
                $firstname,
                $lastname,
                $username,
                $email,
                $phone,
                $password,
            );

            if ($this->UserModel->alreadyExist($_POST["email"])) {
                $data['title'] = 'signUp';
                $data['userData'] = $userdata;
                $data['msg'] = "email already exisit";
                $this->view('nav', $data);
                $this->view('signup', $data);
                $this->view('footer');
                return;
            } else {
                $this->UserModel->signUp($userdata);
                $data['title'] = 'Login';
                $data['msg'] = "Successfully Resgister Login Now..";
                $this->view('nav', $data);
                $this->view('login', $data);
                $this->view('footer');
            }
        } else {
            $data['title'] = 'signUp';
            $this->view('nav', $data);
            $this->view('signup', $data);
            $this->view('footer');
        }
    }
}
