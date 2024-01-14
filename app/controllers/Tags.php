<?php
class Tags extends Controller {
    public function __construct(){
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        $tags = $this->tagModel->showTags();
        $countTag = $this->tagModel->countTag();
        $this->view('admin/tags',['tags'=>$tags , 'countTag'=>$countTag]);
    }
    public function create(){
        if (isset($_POST["addTag"])) {
            if ($_POST['tagName'] == ' ') {
                $name_error = 'Invalid Tag Name';
            } else {
                $name_error = '';
            }
            if ($name_error == '') {
                $this->tagModel->getTag()->setName(trim($_POST['tagName']));
                if ($this->tagModel->create($this->tagModel->getTag())) {
                    header('location: http://localhost/wikiApp/tags');
                } else {
                    $error_tag = [
                        'name_error' => $name_error,
                    ];
                    header('location: http://localhost/wikiApp/tags');

                }
            } else {
                $error_tag = [
                    'name_error' => $name_error,
                ];
                $this->view('admin/dashboard', $error_tag);
            }
        }
    }    public function delete(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        if (isset($_POST["deleteTag"])) {
            $this->tagModel->getTag()->setId($_POST['idTag']);
            $this->tagModel->delete($this->tagModel->getTag());
            header('location: http://localhost/wikiApp/tags');
        }
    }
    public function edit(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        if(isset($_POST['editTag'])){
            if ($_POST['tagName'] == ' ') {
                $error_tag = 'Invalid Tag Name';
            } else {
                $error_tag = '';
            }
            if ($error_tag == '') {
                $this->tagModel->getTag()->setId($_POST['idTag']);
                $this->tagModel->getTag()->setName(trim($_POST['tagName']));
                if ($this->tagModel->edit($this->tagModel->getTag())) {
                    $this->view('admin/tags');
                } else {
                    $error_tag = [
                        'name_error' => $error_tag,
                    ];
                    header('location: http://localhost/wikiApp/tags');
                }
            } else {
                $error_tag = [
                    'name_error' => $error_tag,
                ];
                $this->view('admin/tags', $error_tag);
            }
        }
    }
    public function countTag(){
        if (!isAdmin()) {
            goToPage('/pages/notfound');
        }
        $this->tagModel->countTag();
    }

}