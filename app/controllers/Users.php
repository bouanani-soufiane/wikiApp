<?php
class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('UserDAO');
    }

    public function register(){
        if (isset($_POST["registre"])) {

            if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['name']) || trim($_POST['name']) === '') {
                $name_error = 'Invalid name format';
            } else {
                $name_error = '';
            }

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email_error = 'Invalid email address';
            } else {
                $email_error = '';
            }

            if ($_POST['password'] == ' ') {
                $password_error = 'Invalid password format';
            } else {
                $password_error = '';
            }

            if ($_POST['password'] !== $_POST['confirm-password']) {
                $confirm_password_error = 'Passwords do not match';
            } else {
                $confirm_password_error = '';
            }
            if ($email_error == '' && $name_error == '' && $password_error == '' && $confirm_password_error == '') {
                $this->userModel->getUser()->setName(trim($_POST['name']));
                $this->userModel->getUser()->setEmail(trim($_POST['email']));
                $this->userModel->getUser()->setPassword($_POST['password']);
                $this->userModel->getUser()->setRole(trim($_POST['role']));
                if ($this->userModel->register($this->userModel->getUser())) {
                    $rowUser = $this->userModel->selectLastUser();
                    $_SESSION['userId'] = $rowUser['userId'];
                    $_SESSION['userName'] = $rowUser['userName'];
                    $_SESSION['userEmail'] = $rowUser['email'];
                    $_SESSION['userRole'] = $rowUser['role'];
                    $this->view('users/login');
                } else {
                    $error_user = [
                        'email_error' => 'email already exist',
                        'name_error' => $name_error,
                        'password_error' => $password_error,
                        'confirm_password_error' => $confirm_password_error
                    ];
                    $this->view('users/register',$error_user);
                }
            } else {
                $error_user = [
                    'email_error' => $email_error,
                    'name_error' => $name_error,
                    'password_error' => $password_error,
                    'confirm_password_error' => $confirm_password_error
                ];
                $this->view('users/register', $error_user);
            }
        }
        $error_user = [
            'email_error' => '',
            'name_error' => '',
            'password_error' => '',
            'confirm_password_error' => ''
        ];
            $this->view('users/register',$error_user);
    }
    public function login()
    {
        if (isset($_POST['login'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email_error = 'Invalid email address';
            } else {
                $email_error = '';
            }

            if ($_POST['password'] == ' ') {
                $password_error = 'Invalid password format';
            } else {
                $password_error = '';
            }

            if ($email_error == '' && $password_error == '') {
                $this->userModel->getUser()->setEmail(trim($_POST['email']));
                $this->userModel->getUser()->setPassword($_POST['password']);

                $user = $this->userModel->verifyUser($this->userModel->getUser());

                if ($user != false) {
                    $_SESSION['userId'] = $user['userId'];
                    $_SESSION['userName'] = $user['userName'];
                    $_SESSION['userEmail'] = $user['email'];
                    $_SESSION['userRole'] = $user['role'];

                    if ($_SESSION['userRole'] == 'admin') {
                        header('location: http://localhost/wikiApp/dashboard');
                    } else {
                        header('location: http://localhost/wikiApp');
                    }
                }
                $error_user = [
                    'email_error' => 'user not found',
                    'password_error' => $password_error
                ];
                $this->view('users/login', $error_user);
            }else{
                $error_user = [
                    'email_error' => 'user not found',
                    'password_error' => $password_error
                ];
                $this->view('users/login', $error_user);
            }
        }else{
            $error_user = [
                'email_error' => '',
                'password_error' => ''
            ];
            $this->view('users/login',$error_user);
        }
    }
    public function logout()
    {
        session_destroy();
        header('location: http://localhost/wikiApp/users/login');
    }
    public function index()
    {
        $this->view('pages/index');

    }
    public function countUsers(){
        $this->userModel->countUser();
    }


}