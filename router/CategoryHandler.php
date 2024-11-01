<?php
require_once 'config.php';

class CategoryHandler {
    private $conn;

    public function __construct($config) {
        $dbConnection = new DBConnection($config);
        $this->conn = $dbConnection->getConnection();
    }

    public function getCategoryBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE slug = :slug");
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArticlesByCategory($categorySlug) {
        $stmt = $this->conn->prepare("
            SELECT a.* 
            FROM articles a
            JOIN article_categories ac ON a.id = ac.article_id
            JOIN categories c ON ac.category_id = c.id
            WHERE c.slug = :slug
            ORDER BY a.created_at DESC
        ");
        $stmt->bindParam(':slug', $categorySlug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>