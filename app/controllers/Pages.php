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

    public function profile($id = null){
        if(!isset($id) || !isLogged() || isAdmin()){
            header("location: http://localhost/wikiApp");
        }
        $wikis = $this->wikiModel->showWikiAuthor($id);
        $tags = $this->tagModel->showTags();

        $this->view('users/profile',['wiki'=>$wikis ,'tags'=>$tags ]);
    }
    public function notfound()
    {
        $this->view('pages/404');
    }
}