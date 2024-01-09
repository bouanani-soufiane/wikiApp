<?php
class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
    }
    public function index(){
        $tags = $this->wikiModel->showTags();
        $this->view('admin/tags',['tags'=>$tags]);
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
                    $this->view('admin/tag');
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
    }
    public function delete(){
        if (isset($_POST["deleteTag"])) {
            $this->tagModel->getTag()->setId($_POST['idTag']);
            $this->tagModel->delete($this->tagModel->getTag());
            header('location: http://localhost/wikiApp/tags');
        }
    }
    public function edit(){
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

}