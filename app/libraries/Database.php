<?php

class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbname = DB_NAME;

    private static ?Database $instance = null;

    private ?PDO $conn = null;
    private ?PDOStatement $stmt = null;
    private string $error = '';

    private function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }

    public function prepare(string $sql): void
    {
        $this->stmt = $this->conn->prepare($sql);
    }

    public function bind(string $param, $value, int $type = PDO::PARAM_STR): void
    {
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(): bool
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception("Query execution failed: " . $this->error);
        }
    }

    public function fetchAll(): array
    {
        return $this->stmt->fetchAll();
    }

    public function fetch(): ?array
    {
        return $this->stmt->fetch() ?: null;
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }


    public function getError(): string
    {
        return $this->error;
    }
}