<?php
class Tags extends Controller {
    public function __construct(){
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        $tags = $this->tagModel->showTags();
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

            $this->tagModel->getTag()->setId(trim($_POST['idTag']));
            if ($this->tagModel->delete($this->tagModel->getTag())) {
                header('location: http://localhost/wikiApp/tags');
            }

        }
    }

}