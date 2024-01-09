<?php
class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');

    }
    public function index(){
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('users/author_post',['categs'=>$categs , 'tags'=>$tags]);
    }
    public function create(){
       if (isset($_POST["save"])) {
           if ($_POST['wikiTitle'] == ' ') {
               $title_error = 'Invalid wiki title';
           } else {
               $title_error = '';
           }
           if ($_POST['wikiDescription'] == ' ') {
               $desc_error = 'Invalid wiki description';
           } else {
               $desc_error = '';
           }
           if ($_POST['wikiContent'] == ' ') {
               $content_error = 'Invalid wiki content';
           } else {
               $content_error = '';
           }
           if ($title_error == '' &&  $desc_error == '' && $content_error == '' ) {
               $this->wikiModel->getWiki()->setTitre(trim($_POST['wikiTitle']));
               $this->wikiModel->getWiki()->setDescription(trim($_POST['wikiDescription']));
               $this->wikiModel->getWiki()->setContent(trim($_POST['wikiContent']));
               $tmp_name = $_FILES['image']['tmp_name'];
               $imageName = file_get_contents($tmp_name);
               $this->wikiModel->getWiki()->setImage($imageName);
               $this->wikiModel->getWiki()->getUser()->setId($_SESSION['userId']);
               $this->wikiModel->getWiki()->getCategory()->setId(trim($_POST['category']));

               if ($this->wikiModel->create($this->wikiModel->getWiki())) {








                   $this->view('pages/index');
               } else {
                   header('location: http://localhost/wikiApp/login');
               }
           } else {
               if ($title_error != '' || $desc_error != '' || $content_error != '') {
                   $error_wiki = [
                       'title_error' => $title_error,
                       'desc_error' => $desc_error,
                       'content_error' => $content_error
                   ];
                   header('location: http://localhost/wikiApp/tags');
               }


           }
       }
    }

}

//               echo "<pre>";
//               var_dump($this->wikiModel);
//               die();