<?php

class Dashboard extends Controller
{
    private $categoryModel;
    private $wikiModel;
    private $userModel;
    private $tagModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('CategoryDAO');
        $this->wikiModel = $this->model('WikiDAO');
        $this->userModel = $this->model('UserDAO');
        $this->tagModel = $this->model('TagDAO');
    }

    public function index()
    {
        if (!isAdmin()) {
            $this->redirectToNotFound();
        }

        $categories = $this->categoryModel->showCategories();
        $wikiCount = $this->wikiModel->countWikis();
        $usersCount = $this->userModel->countUsers();
        $tagCount = $this->tagModel->countTags();
        $categoryCount = $this->categoryModel->countCategories();

        $this->view('admin/dashboard', [
            'categories' => $categories,
            'wikiCount' => $wikiCount,
            'usersCount' => $usersCount,
            'tagCount' => $tagCount,
            'categoryCount' => $categoryCount
        ]);
    }

    private function redirectToNotFound()
    {
        header('Location: /pages/notfound');
        exit();
    }
}