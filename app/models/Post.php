    <?php
    class Post {
        private $conn;

        public function __construct()
        {
            $this->conn = Database::getInstance()->getConnection();
        }

        public function getPosts()
        {
//            $query = "SELECT * FROM posts";
//            $statement = $this->conn->prepare($query);
//            $statement->execute();
//            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//            return $posts;
        }
    }
