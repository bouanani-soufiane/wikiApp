<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Wikis extends Controller {
    public function __construct(){
        $this->wikiModel = $this->model('WikiDAO');
        $this->wikiTagModel = $this->model('WikiTagDAO');
        $this->categoryModel = $this->model('CategoryDAO');
        $this->tagModel = $this->model('TagDAO');
    }
    public function index(){
        if(!isLogged() || !isAdmin()){
            header("location: http://localhost/wikiApp");
        }
        $wiki = $this->wikiModel->showWiki();
        $tags = $this->tagModel->showTags();
        $countWiki = $this->wikiModel->countWiki();
        $this->view('admin/wikis',['wiki'=>$wiki , 'countWiki'=>$countWiki]);
    }
    public function create(){
        if(!isLogged() || isAdmin()){
            header("location: http://localhost/wikiApp");
        }
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('users/author_post',['categs'=>$categs , 'tags'=>$tags]);
    }

    public function store(){
       if (isset($_POST["save"])) {
           if (isset($_FILES['image'])) {
               $uploadedFile = $_FILES['image'];
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
               $this->wikiModel->getWiki()->setImage($imgName);
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
    public function showSingle($id = null){
        if($id == null){
            header('location: http://localhost/wikiApp');

        }
        $wiki = $this->wikiModel->showSingleWiki($id);
        $this->view('pages/singleWiki',['wiki'=>$wiki ]);
    }
    public function showWikiCateg($id = null){
        if($id == null){
            header('location: http://localhost/wikiApp');

        }
        $wiki = $this->wikiModel->showWikiCateg($id);
        $this->view('pages/WikiCateg',['wiki'=>$wiki ]);
    }
    public function edit($id = null){
        if($id == null || isAdmin() || !isLogged()){
            header('location: http://localhost/wikiApp');

        }
        $wiki = $this->wikiModel->showSingleWiki($id);
        $categs = $this->categoryModel->showCategories();
        $tags = $this->tagModel->showTags();
        $this->view('pages/updateSignleWiki',['categs'=>$categs , 'tags'=>$tags,'wiki'=>$wiki]);
    }
    public function update(){
        if(isset($_POST['save'])){
            $title_error = $desc_error = $content_error = '';
            if (isset($_FILES['image'])) {
                $uploadedFile = $_FILES['image'];
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
                $this->wikiModel->getWiki()->setImage($imgName);

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
                    header('location: http://localhost/wikiApp/pages/profile/'.$_SESSION['userId'].'?' );
                    exit;
                }
            } else {
                $error_wiki = [
                    'title_error' => $title_error,
                    'desc_error' => $desc_error,
                    'content_error' => $content_error
                ];
                header('location: http://localhost/wikiApp/?');
                exit;
            }
        }else{
                header("location: http://localhost/wikiApp");

        }
    }
    public function delete($id){
        $this->wikiModel->delete($id);
        header('location: http://localhost/wikiApp/pages/profile/'.$_SESSION['userId'].'?' );

    }
    public function archive($id){
        $this->wikiModel->archive($id);
        header('location: http://localhost/wikiApp/wikis');

    }
    public function countWiki(){
        $this->wikiModel->countWiki();
    }
    public function getwikis(){
        $data = json_decode(file_get_contents("php://input"), true);

        $wikis =  $this->wikiModel->searchWiki($data['search']);
        $array = [];
        foreach ($wikis as $wiki) {
            $data = [
                'id' => $wiki->getId(),
                'Titre' => $wiki->getTitre(),
                'Description' => $wiki->getDescription(),
                'image' => $wiki->getImage(),
                'Category' => [
                    'name' => $wiki->getCategory()->getName(),
                    'image' => $wiki->getCategory()->getImage(),
                    'id' => $wiki->getCategory()->getId(),
                ],
                'user' => [
                    'name' => $wiki->getUser()->getName(),
                ]
            ];
            $array[] = $data;
        }

        echo json_encode($array);
    }



}

