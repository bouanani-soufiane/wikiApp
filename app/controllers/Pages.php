<?php
class Pages extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
    }
    public function index(){
        $categs = $this->categoryModel->showLastThreeCategories();
        $wiki = $this->wikiModel->showLsatWikis();
        $tags = $this->tagModel->showTags();
        $this->view('pages/index',['categs'=>$categs , 'wiki'=>$wiki]);
    }

    public function about(){
        $this->view('pages/about');
    }
}