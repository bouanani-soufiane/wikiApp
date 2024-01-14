<?php
require_once __DIR__ . './entities/User.php';

class UserDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function selectLastUser(): ?User {
        $query = "SELECT * FROM user ORDER BY userId DESC LIMIT 1";
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = new User();
            $user->setId($result['userId'])
                ->setName($result['userName'])
                ->setEmail($result['email'])
                ->setPassword($result['password'])
                ->setRole($result['role']);

            return $user;
        }

        return null;
    }

    public function verifyEmail(string $email): bool
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC) === false;
    }

    public function register(User $user): bool
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $role = $user->getRole();

        if ($this->verifyEmail($email)) {
            $query = "INSERT INTO user (userName, email, password, role) VALUES (:name, :email, :password, :role)";
            $statement = $this->conn->prepare($query);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':role', $role);
            $statement->execute();
            return true;
        }
        return false;
    }

    public function verifyUser(User $user): array|bool
    {
        $email = $user->getEmail();
        $password = $user->getPassword();

        $query = "SELECT * FROM user WHERE email = :email";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }

    public function countUser(): int
    {
        $query = "SELECT COUNT(*) AS usersCount FROM user WHERE role = 'author'";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int)$result->usersCount;
    }
}