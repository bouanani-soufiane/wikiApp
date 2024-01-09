<?php
class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
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

                   $idwiki = $this->wikiModel->getLastWikiId(7);

                   $this->wikiTagModel->getWikiTag()->getTag()->setId(7);
                   $this->wikiTagModel->getWikiTag()->getWiki()->setId( $idwiki);

                   $this->wikiTagModel->create($this->wikiTagModel->getWikiTag()) ;

                   $this->conn->commit();

                   header('location: http://localhost/wikiApp');
                   exit();

           } else {
               if ($title_error != '' || $desc_error != '' || $content_error != '') {
                   $error_wiki = [
                       'title_error' => $title_error,
                       'desc_error' => $desc_error,
                       'content_error' => $content_error
                   ];
                   header('location: http://localhost/wikiApp');
               }
           }
                   header('location: http://localhost/wikiApp');
       }
    }

}

//               echo "<pre>";
//               var_dump($this->wikiModel);
//               die();


