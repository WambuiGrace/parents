<?php
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '', // Your actual database password
    'database' => 'parents_in_sync'
];

class DBConnection {
    private $pdo;

    public function __construct($config) {
        try {
            $this->pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4",
                $config['username'],
                $config['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

// Create a global PDO connection
try {
    $pdo = (new DBConnection($db_config))->getConnection();
} catch(Exception $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>