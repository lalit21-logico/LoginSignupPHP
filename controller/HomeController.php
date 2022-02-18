<?php
require_once "controller.php";
require 'models/UserModel.php';

class HomeController extends Controller
{
    public function __construct($BASE_URL)
    {
        $this->UserModel =  new UserModel();
        $this->BASE_URL = $BASE_URL;;
    }

    public function index()
    {
        if (isset($_SESSION['is_admin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/admin");
            exit;
        }
        $act = isset($_GET['act']) ? $_GET['act'] : "a";
        if (!isset($_GET['act'])) {
            $act = $_SERVER['REQUEST_URI'];
            // echo $act;
        }
        switch ($act) {
            case '/LSS/signUp':
                $this->signUp();
                break;
            case '/LSS/login':
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
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }
        $result = $this->UserModel->getUser($_SESSION['useremail']);

        foreach ($result->fetch_all(MYSQLI_ASSOC) as $d) {
            $data['userdata'] = $d;
        }
        $data['title'] = 'Home page';
        $data['msg'] = $msg;
        $data['msgS'] = $msgs;
        // $this->view('nav', $data);
        $this->view('home', $data);
        // $this->view('footer');
    }

    public function delete()
    {
        if (!isset($_SESSION['loggedin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }

        if (true == isset($_POST['userId'])) {
            $id = $this->cleanData($_POST["userId"]);
            $this->UserModel->delete($id);
            unset($_SESSION['loggedin']);
            unset($_SESSION['useremail']);
            echo json_encode(array("result" => "deleted"));
        }
    }

    public function update()
    {
        if (!isset($_SESSION['loggedin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }

        if (true == isset($_POST['firstname'])) {
            $id = $this->cleanData($_POST["id"]);
            $firstname = $this->cleanData($_POST["firstname"]);
            $lastname = $this->cleanData($_POST["lastname"]);
            $username = $this->cleanData($_POST["username"]);
            $email = $this->cleanData($_POST["email"]);
            $phone = $this->cleanData($_POST["phone"]);
            $password = $this->cleanData($_POST["password"]);
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
                echo json_encode(array("is_update" => false));
                return;
            }
            $_SESSION['useremail'] = $email;
            $this->UserModel->update($userdata, $id);
            $msg = 'updated success';
            echo json_encode(array("is_update" => true));
            return true;
        }
    }

    public function logout()
    {
        if (!isset($_SESSION['loggedin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }
        $_SESSION['loggedin'] = false;
        $_SESSION['useremail'] = "";
        unset($_SESSION['loggedin']);
        unset($_SESSION['useremail']);
        $data['title'] = 'Login';
        echo json_encode(array("k" => "logout", "data" => $data));
        // $this->view('login', $data);
        return;
    }


    public function login($msg = "")
    {
        if (isset($_SESSION['loggedin'])) {
            if (isset($_SESSION['is_admin'])) {
                header("Location: " . $this->BASE_URL . "/LSS/admin");
                exit;
            }
            header("Location: " . $this->BASE_URL . "/LSS/");
            exit;
        }
        $data['msgS'] = $msg;
        if (true == isset($_POST['email'])) {
            $email = $this->cleanData($_POST["email"]);
            $password =  $this->cleanData($_POST["password"]);
            if ($this->UserModel->login($email, $password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email;
                if ($this->UserModel->checkRole($email) == "admin") {
                    $_SESSION['is_admin'] = true;
                    header("Location: " . $this->BASE_URL . "/LSS/admin");
                    exit;
                }
                header("Location: " . $this->BASE_URL . "/LSS/");
                exit;
            } else {
                $data['msgS'] = 'email or password is incorrect';
            }
        }
        $data['title'] = 'Login';
        $data['page'] = "login";
        $this->view('login', $data);
    }

    public function signUp()
    {
        if (isset($_SESSION['loggedin'])) {
            if (isset($_SESSION['is_admin'])) {
                header("Location: " . $this->BASE_URL . "/LSS/admin");
                exit;
            }
            header("Location: " . $this->BASE_URL . "/LSS/");
            exit;
        }
        if (true == isset($_POST['firstname'])) {
            $firstname = $this->cleanData($_POST["firstname"]);
            $lastname = $this->cleanData($_POST["lastname"]);
            $username = $this->cleanData($_POST["username"]);
            $email = $this->cleanData($_POST["email"]);
            $phone = $this->cleanData($_POST["phone"]);
            $password = $this->cleanData($_POST["password"]);
            $role = $this->cleanData($_POST["role"]);
            $userdata = array(
                $firstname,
                $lastname,
                $username,
                $email,
                $phone,
                $password,
                $role,
            );


            if ($this->UserModel->alreadyExist($_POST["email"])) {
                $data['title'] = 'signUp';
                $data['userData'] = $userdata;
                $data['msg'] = "email already exisit";
                $data['page'] = "signUp";
                $this->view('login', $data);
                return;
            } else {
                $this->UserModel->signUp($userdata);
                if ($role == "admin") {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['useremail'] = $email;
                    $_SESSION['is_admin'] = true;
                    header("Location: " . $this->BASE_URL . "/LSS/admin");
                    return;
                } else {
                    $data['title'] = 'Home';
                    $_SESSION['loggedin'] = true;
                    $_SESSION['useremail'] = $email;
                    header("Location: " . $this->BASE_URL . "/LSS/");
                    return;
                }
            }
        } else {
            $data['page'] = "signUp";
            $data['title'] = 'signUp';
            $this->view('login', $data);
        }
    }

    public function cleanData($value)
    {
        $value = mysqli_real_escape_string($this->UserModel->conn, trim($value));
        return $value;
    }
}
