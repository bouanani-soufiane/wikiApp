<?php
class Dashboard extends Controller {
    public function __construct(){
        $this->categoryModel = $this->model('CategoryDAO');
    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $this->view('admin/dashboard',['categs'=>$categs]);
    }

}