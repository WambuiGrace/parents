<?php
require_once 'includes/config.php';

class ArticleHandler {
    private $conn;

    public function __construct($config) {
        $dbConnection = new DBConnection($config);
        $this->conn = $dbConnection->getConnection();
    }

    public function getFeaturedArticles() {
        $sql = "SELECT id, title, summary, image_path, slug FROM articles ORDER BY created_at DESC LIMIT 3";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM articles WHERE slug = :slug");
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>