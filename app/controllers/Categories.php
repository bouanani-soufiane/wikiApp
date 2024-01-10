<?php
class Categories extends Controller {
    public function __construct(){

        $this->categoryModel = $this->model('CategoryDAO');
    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $countCateg = $this->categoryModel->countCateg();

        $this->view('admin/categories',['categs'=>$categs ,'countCateg'=>$countCateg]);
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
                $tmp_name = $_FILES['categorieImage']['tmp_name'];
                $imageName = file_get_contents($tmp_name);
                $this->categoryModel->getCategory()->setImage($imageName);
                if ($this->categoryModel->create($this->categoryModel->getCategory())) {
                    $this->view('admin/categories');
                } else {
                    $error_categ = [
                        'name_error' => $name_error,
                    ];
                    header('location: http://localhost/wikiApp/categories');
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
            $this->categoryModel->getCategory()->setId($_POST['idCateg']);
            $this->categoryModel->delete($this->categoryModel->getCategory());
            header('location: http://localhost/wikiApp/categories');
        }
    }
    public function edit(){
        if(isset($_POST['editCategorie'])){
            if ($_POST['CategorieName'] == ' ') {
                $error_categ = 'Invalid Category Name';
            } else {
                $error_categ = '';
            }
            if ($error_categ == '') {
                $this->categoryModel->getCategory()->setId(trim($_POST['idCateg']));
                $this->categoryModel->getCategory()->setName(trim($_POST['CategorieName']));
                $tmp_name = $_FILES['categorieImage']['tmp_name'];
                $imageName = file_get_contents($tmp_name);
                $this->categoryModel->getCategory()->setImage($imageName);
                if ($this->categoryModel->edit($this->categoryModel->getCategory())) {
                    $this->view('admin/categories');
                } else {
                    $error_categ = [
                        'name_error' => $error_categ,
                    ];
                    header('location: http://localhost/wikiApp/categories');
                }
            } else {
                $error_categ = [
                    'name_error' => $error_categ,
                ];
                $this->view('admin/dashboard', $error_categ);
            }
        }
    }
    public function countCateg(){
        $this->categoryModel->countCateg();
    }
}
