<?php
require_once "controller.php";
// require 'models/UserModel.php';

class AdminController extends Controller
{
    public function __construct($BASE_URL)
    {
        $this->UserModel =  new UserModel();
        $this->BASE_URL = $BASE_URL;
    }

    public function index()
    {
        $act = isset($_GET['act']) ? $_GET['act'] : "a";
        if (!isset($_GET['act'])) {
            $act = $_SERVER['REQUEST_URI'];
            // echo $act;
        }
        switch ($act) {
            case 'adminUpdate':
                $this->update();
                break;
            case '/LSS/admin/logout':
                $this->logout();
                break;
            default:
                $this->home();
                break;
        }
    }


    public function home()
    {
        if (!isset($_SESSION['loggedin']) and !isset($_SESSION['is_admin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }
        if ($_SESSION['is_admin'] != true) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }
        $result = $this->UserModel->getAll();

        $data['userdata'] = $result->fetch_all(MYSQLI_ASSOC);
        $data['title'] = 'Admin Home page';

        $this->view('admin/adminHome', $data);
    }


    public function update()
    {
        if (!isset($_SESSION['loggedin']) and !isset($_SESSION['is_admin'])) {
            echo json_encode(array("is_update" => "logout"));
            return;
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
            $role = $this->cleanData($_POST["role"]);
            $userdata = array(
                $firstname,
                $lastname,
                $username,
                $email,
                $phone,
                $role,
            );

            $existing_email = $this->UserModel->getEmail($id);
            if ($existing_email != $email  and $this->UserModel->alreadyExist($email, "forUpdate")) {
                echo json_encode(array("is_update" => false, "ex" => $existing_email));
                return;
            }


            if ($_SESSION['useremail'] == $existing_email) {
                $_SESSION['useremail'] = $email;
            }

            $this->UserModel->adminUpdate($userdata, $id);
            if ($_SESSION['useremail'] == $email and $role != "admin") {
                unset($_SESSION['loggedin']);
                unset($_SESSION['useremail']);
                unset($_SESSION['is_admin']);
                echo json_encode(array("is_update" => "selfUser",));
                return true;
            }
            echo json_encode(array("is_update" => true));
            return true;
        }
    }

    public function logout()
    {
        if (!isset($_SESSION['is_admin'])) {
            header("Location: " . $this->BASE_URL . "/LSS/login");
            exit;
        }
        $_SESSION['loggedin'] = false;
        $_SESSION['useremail'] = "";
        $_SESSION['is_admin'] = false;
        unset($_SESSION['loggedin']);
        unset($_SESSION['useremail']);
        unset($_SESSION['is_admin']);
        header("Location: " . $this->BASE_URL . "/LSS/login");
        exit;
    }

    public function cleanData($value)
    {
        $value = mysqli_real_escape_string($this->UserModel->conn, trim($value));
        return $value;
    }
}
