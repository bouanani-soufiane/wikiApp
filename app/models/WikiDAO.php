<?php
require_once __DIR__.'./entities/Tag.php';

class TagDAO extends Controller
{
    private $conn;
    private Wiki $wiki;
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->wiki = new Wiki();
    }
    public function getWiki(): Wiki
    {
        return $this->wiki;
    }
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;
        return $this;
    }
    public function index(){
        $this->view('pages/index');
    }
    public function create(Tag $tag){
        $name = $tag->getName();
        $stmt = $this->conn->prepare("INSERT INTO tag (tagName) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
