<?php
class Tags extends Controller {
    public function __construct(){
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        $tags = $this->tagModel->showTags();
        $this->view('admin/tags',['tags'=>$tags]);
    }

}