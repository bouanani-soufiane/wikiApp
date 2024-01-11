<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        $wiki = $this->wikiModel->showWiki();
        $tags = $this->tagModel->showTags();
        $countWiki = $this->wikiModel->countWiki();
        $this->view('admin/wikis',['wiki'=>$wiki , 'countWiki'=>$countWiki]);
    }
    public function create(){
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('users/author_post',['categs'=>$categs , 'tags'=>$tags]);
    }

    public function store(){
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

                   $idwiki = $this->wikiModel->getLastWikiId($_SESSION['userId']);
                   $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

                   foreach ($tags as $tagId) {
                       $wikiTag = $this->wikiTagModel->getWikiTag();
                       $wikiTag->getTag()->setId($tagId);
                       $wikiTag->getWiki()->setId($idwiki);
                       $this->wikiTagModel->create($wikiTag);
                   }

               }
                   header('location: http://localhost/wikiApp');

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
    public function showSingle($id){
        $wiki = $this->wikiModel->showSingleWiki($id);
        $this->view('pages/singleWiki',['wiki'=>$wiki ]);
    }
    public function showWikiCateg($id){
        $wiki = $this->wikiModel->showWikiCateg($id);
        $this->view('pages/WikiCateg',['wiki'=>$wiki ]);
    }
    public function edit($id){
        $wiki = $this->wikiModel->showSingleWiki($id);
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('pages/updateSignleWiki',['categs'=>$categs , 'tags'=>$tags,'wiki'=>$wiki]);
    }
    public function update(){
        if(isset($_POST['save'])){
            $title_error = $desc_error = $content_error = '';

            if (empty(trim($_POST['wikiTitle']))) {
                $title_error = 'Invalid wiki title';
            }
            if (empty(trim($_POST['wikiDescription']))) {
                $desc_error = 'Invalid wiki description';
            }
            if (empty(trim($_POST['wikiContent']))) {
                $content_error = 'Invalid wiki content';
            }

            if ($title_error == '' && $desc_error == '' && $content_error == '') {
                $this->wikiModel->getWiki()->setId($_POST['id']);
                $this->wikiModel->getWiki()->setTitre(trim($_POST['wikiTitle']));
                $this->wikiModel->getWiki()->setDescription(trim($_POST['wikiDescription']));
                $this->wikiModel->getWiki()->setContent(trim($_POST['wikiContent']));
                if ($_FILES['image']['size'] > 0) {
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $imageName = file_get_contents($tmp_name);
                    $this->wikiModel->getWiki()->setImage($imageName);
                }
                $this->wikiModel->getWiki()->getUser()->setId($_SESSION['userId']);
                $this->wikiModel->getWiki()->getCategory()->setId(trim($_POST['category']));
                if(isset($_POST['deletetags'])){
                    $this->wikiTagModel->delete($_POST['deletetags'], $_POST['id']);
                }
                if(isset($_POST['addtags'])){
                    $tags = isset($_POST['addtags']) ? $_POST['addtags'] : [];

                    foreach ($tags as $tagId) {
                        $wikiTag = $this->wikiTagModel->getWikiTag();
                        $wikiTag->getTag()->setId($tagId);
                        $wikiTag->getWiki()->setId($_POST['id']);
                        $this->wikiTagModel->create($wikiTag);
                    }                }
                if ($this->wikiModel->update($this->wikiModel->getWiki())) {

                    $this->view('pages/updateSingleWiki');
                } else {
                    $error_wiki = [
                        'title_error' => 'Failed to update wiki.'
                    ];
                    header('location: http://localhost/wikiApp/?' . http_build_query($error_wiki));
                    exit;
                }
            } else {
                $error_wiki = [
                    'title_error' => $title_error,
                    'desc_error' => $desc_error,
                    'content_error' => $content_error
                ];
                header('location: http://localhost/wikiApp/?' . http_build_query($error_wiki));
                exit;
            }
        }
    }
    public function delete($id){
        $this->wikiModel->delete($id);
        header('location: http://localhost/wikiApp/');

    }
    public function archive($id){
        $this->wikiModel->archive($id);
        header('location: http://localhost/wikiApp/wikis');

    }
    public function countWiki(){
        $this->wikiModel->countWiki();
    }


}


