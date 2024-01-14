<?php
class Pages extends Controller {
    private $wikiModel;
    private $categoryModel;
    private $tagModel;
    private $wikiTagModel;

    public function __construct() {
        $this->wikiModel = $this->model('WikiDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
    }

    public function index() {
        $categories = $this->categoryModel->showLastThreeCategories();
        $wikis = $this->wikiModel->showLatestWikis();
        $tags = $this->tagModel->showTags();

        $this->view('pages/index', [
            'categories' => $categories,
            'wikis' => $wikis,
            'tags' => $tags
        ]);
    }

    public function profile($id = null) {
        if (!$id || !isLogged() || isAdmin()) {
            redirectToPage('/');
        }

        $wikis = $this->wikiModel->showWikiAuthor($id);
        $tags = $this->tagModel->showTags();

        $this->view('users/profile', [
            'wikis' => $wikis,
            'tags' => $tags
        ]);
    }

    public function notfound() {
        $this->view('pages/404');
    }
}