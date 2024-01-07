<?php
class Pages extends Controller {
    public function __construct(){
        $this->postModel = $this->model('Post');
    }
    public function index(){
        $posts = $this->postModel->getPosts();
        $this->view('pages/index');
    }
    public function about(){
        $this->view('pages/about');
    }
}