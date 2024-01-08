<?php
class Categories extends Controller {
    public function __construct(){
        $this->categoryModel = $this->model('CategoryDAO');
    }


}