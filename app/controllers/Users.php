<?php
class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){

            $this->view('users/register');


    }
    public function login(){
        $this->view('users/login');

    }

    public function createUserSession($user){
    }
    public function logout(){

    }
    public function isLoggedIn(){
    }
}