<?php
class Dashboard extends Controller {
    public function __construct(){
        $this->categoryModel = $this->model('CategoryDAO');
        $this->wikiModel = $this->model('WikiDAO');
        $this->userModel = $this->model('UserDAO');
        $this->tagModel = $this->model('TagDAO');
        $this->categoryModel = $this->model('CategoryDAO');



    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $wikiCount = $this->wikiModel->countWiki();
        $usersCount = $this->userModel->countUser();
        $countTag = $this->tagModel->countTag();
        $countCateg = $this->categoryModel->countCateg();

        $this->view('admin/dashboard',['categs'=>$categs, 'wikiCount'=>$wikiCount ,'usersCount'=>$usersCount,'countTag'=>$countTag,'countCateg'=>$countCateg]);
    }

}