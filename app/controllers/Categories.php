<?php
class Categories extends Controller {
    public function __construct(){

        $this->categoryModel = $this->model('CategoryDAO');
    }
    public function index(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        $categs = $this->categoryModel->showCategories();
        $countCateg = $this->categoryModel->countCateg();

        $this->view('admin/categories',['categs'=>$categs ,'countCateg'=>$countCateg]);
    }
    public function create(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        if (isset($_POST["addCategorie"])) {
            if (isset($_FILES['categorieImage'])) {
                $uploadedFile = $_FILES['categorieImage'];
                $name = $uploadedFile['name'];
                $size = $uploadedFile['size'];
                $tmp_name = $uploadedFile['tmp_name'];
                $error = $uploadedFile['error'];

                $imgName = uploadImage($name, $tmp_name, $size, $error);
                if (is_int($imgName)) {
                    switch ($imgName) {
                        case 1:
                            echo 'Sorry your file is too large. (max 10mb)';
                            break;
                        case 2:
                            echo 'Unsupported format. (jpg, jpeg, png, webp)';
                            break;
                        default:
                            echo 'Unkown error occured';
                            break;
                    }
                }
            } else $imgName = null;
            if ($_POST['CategorieName'] == ' ') {
                $name_error = 'Invalid Category Name';
            } else {
                $name_error = '';
            }
            if ($name_error == '') {
                $this->categoryModel->getCategory()->setName(trim($_POST['CategorieName']));
                $this->categoryModel->getCategory()->setImage($imgName);
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
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }

        if (isset($_POST["deleteCateg"])) {
            $this->categoryModel->getCategory()->setId($_POST['idCateg']);
            $this->categoryModel->delete($this->categoryModel->getCategory());
            header('location: http://localhost/wikiApp/categories');
        }
    }
    public function edit(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        if(isset($_POST['editCategorie'])){
            if (isset($_FILES['categorieImage'])) {
                $uploadedFile = $_FILES['categorieImage'];
                $name = $uploadedFile['name'];
                $size = $uploadedFile['size'];
                $tmp_name = $uploadedFile['tmp_name'];
                $error = $uploadedFile['error'];

                $imgName = uploadImage($name, $tmp_name, $size, $error);
                if (is_int($imgName)) {
                    switch ($imgName) {
                        case 1:
                            echo 'Sorry your file is too large. (max 10mb)';
                            break;
                        case 2:
                            echo 'Unsupported format. (jpg, jpeg, png, webp)';
                            break;
                        default:
                            echo 'Unkown error occured';
                            break;
                    }
                }
            } else $imgName = null;
            if ($_POST['CategorieName'] == ' ') {
                $error_categ = 'Invalid Category Name';
            } else {
                $error_categ = '';
            }
            if ($error_categ == '') {
                $this->categoryModel->getCategory()->setId(trim($_POST['idCateg']));
                $this->categoryModel->getCategory()->setName(trim($_POST['CategorieName']));

                $this->categoryModel->getCategory()->setImage($imgName);


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
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        $this->categoryModel->countCateg();
    }

    public function categories(){
        $categs = $this->categoryModel->showCategories();
        $this->view('pages/categories',['categs'=>$categs ]);

    }
}
