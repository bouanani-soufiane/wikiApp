<?php
class Pages extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $wiki = $this->wikiModel->showWiki();
        $tags = $this->tagModel->showTags();
        $this->view('pages/index',['categs'=>$categs , 'wiki'=>$wiki]);
    }

    public function about(){
        $this->view('pages/about');
    }
}