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

    public function selectLastUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM user ORDER BY userId DESC LIMIT 1");

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public function verifyEmail($email)
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
        if ($this->verifyEmail($email) == true) {
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
    public function verifyUser(User $user)
    {
        $email = $user->getEmail();
        $password = $user->getPassword();
        $role = $user->getRole();

        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $validation = false;

        if ($result != false) {
            $validation = true;
        }

        if ($validation && password_verify($password, $result['password'])) {
            return $result;
        } else {
            return false;
        }
    }

    public function countUser() {
        $query = "SELECT COUNT(*) AS uersCount FROM user where role = 'author'";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->uersCount;
    }
}