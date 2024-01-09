<?php
class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');

    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('users/author_post',['categs'=>$categs , 'tags'=>$tags]);
    }
    public function create(){
       if(isset($_POST['save'])){
           echo "create";
           die();
       }
    }
}

