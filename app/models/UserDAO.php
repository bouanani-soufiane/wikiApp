<?php
require_once __DIR__.'./entities/User.php';

class UserDAO
{
    private $conn;
    private User $user;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->user = new User();
    }
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    public function getUserInfo()
    {
        try {
            $query = "SELECT `userName`, `userEmail`,  `userImage` FROM `user` WHERE userId = 1";
            $result = $this->conn->query($query);

            if ($result === false) {
                throw new Exception("Query failed: ");
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            $user = new User();
            $user->setEmail($row['userEmail']);
            $user->setName($row['userName']);

            return $user;
        } catch (Exception $e) {
            error_log("Error in UserModel: " . $e->getMessage());
            return null;
        }
    }
    public function selectLastUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM user ORDER BY userId LIMIT 1");

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public function verifyUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result == false) {
            return true;
        } else {
            return false;
        }
    }
    public function register(User $user)
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $role = $user->getRole();
        if ($this->verifyUserByEmail($email) == true) {
            $stmt = $this->conn->prepare("INSERT INTO user (userName, email, password, role) VALUES (:name, :email, :password, :role)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);

            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }

}
