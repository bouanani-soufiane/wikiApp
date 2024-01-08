<?php
class Categories extends Controller {
    public function __construct(){
        $this->categoryModel = $this->model('CategoryDAO');
    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $this->view('admin/categories',['categs'=>$categs]);
    }
    public function create(){
        if (isset($_POST["addCategorie"])) {
            if ($_POST['CategorieName'] == ' ') {
                $name_error = 'Invalid Category Name';
            } else {
                $name_error = '';
            }
            if ($name_error == '') {
                $this->categoryModel->getCategory()->setName(trim($_POST['CategorieName']));
                if ($this->categoryModel->create($this->categoryModel->getCategory())) {
                    $this->view('admin/categories');
                } else {
                    $error_categ = [
                        'name_error' => $name_error,
                    ];
                    header('location: http://localhost/wikiApp/dashboard');
                }
            } else {
                $error_categ = [
                    'name_error' => $name_error,
                ];
                $this->view('admin/dashboard', $error_categ);
            }
        }
    }
    public function delete(){
        if (isset($_POST["deleteCateg"])) {

            $this->categoryModel->getCategory()->setId(trim($_POST['idCateg']));
            if ($this->categoryModel->delete($this->categoryModel->getCategory())) {
                header('location: http://localhost/wikiApp/dashboard');
            }
            else {
                $error_categ = [
                    'name_error' => $name_error,
                ];
                header('location: http://localhost/wikiApp/dashboard');
            }

        }
    }
}
