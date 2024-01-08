<?php
class Auth extends Controller {
    public function __construct(){
        $this->postModel = $this->model('Post');
    }
    public function signup()
    {
        if (isset($_POST["registre"])) {
            $user = new UserDAO();

            if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['name'])) {
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

            // If all validations pass, proceed with user registration
            if ($email_error == '' && $name_error == '' && $password_error == '' && $confirm_password_error == '') {
                $user->getUser()->setName(trim($_POST['name']));
                $user->getUser()->setEmail(trim($_POST['email']));
                $user->getUser()->setPassword($_POST['password']);
                $user->getUser()->setRole(trim($_POST['role']));
                if ($user->signup($user->getUser()) == true) {
                    $rowUser = $user->selectLastUser();
                    $_SESSION['userId'] = $rowUser['userId'];
                    $_SESSION['userName'] = $rowUser['userName'];
                    $_SESSION['userEmail'] = $rowUser['userEmail'];
                    $_SESSION['userImage'] = $rowUser['userImage'];
                    $_SESSION['userRole'] = $rowUser['userRole'];
                    header('location:/paroly/public/home/login');
                } else {
                    $error_user = [
                        'email_error' => 'This email exist',
                        'name_error' => $name_error,
                        'password_error' => $password_error,
                        'confirm_password_error' => $confirm_password_error
                    ];
                    $this->view('signup', $error_user);
                }
            } else {
                $error_user = [
                    'email_error' => $email_error,
                    'name_error' => $name_error,
                    'password_error' => $password_error,
                    'confirm_password_error' => $confirm_password_error
                ];
                $this->view('signup', $error_user);
            }
        }
        $error_user = [
            'email_error' => '',
            'name_error' => '',
            'password_error' => '',
            'confirm_password_error' => ''
        ];
        $this->view('signup', $error_user);
    }
}