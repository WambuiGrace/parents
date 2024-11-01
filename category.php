<?php
require_once 'includes/config.php';
require_once 'includes/CategoryHandler.php';

// Get category slug from URL
$categorySlug = $_GET['category'] ?? '';

try {
    $handler = new CategoryHandler($db_config);
    $category = $handler->getCategoryBySlug($categorySlug);
    $articles = $handler->getArticlesByCategory($categorySlug);
} catch(Exception $e) {
    $error = "An error occurred while fetching the content: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($category['name'] ?? 'Category') ?> - Parents in Sync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background-color: #0fd0fb; }
        .article-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .article-link {
            color: #0066cc;
            text-decoration: none;
        }
        .article-link:hover {
            text-decoration: underline;
        }
        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 1rem 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Parents in Sync</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forum.php">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php elseif (!$category): ?>
            <div class="alert alert-warning">Category not found.</div>
        <?php else: ?>
            <h1 class="mb-4 text-center"><?= htmlspecialchars($category['name']) ?></h1>
            
            <?php if (empty($articles)): ?>
                <p class="text-center">No articles available in this category yet.</p>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article-card">
                        <h2 class="h4">
                            <a href="article.php?id=<?= $article['id'] ?>" class="article-link">
                                <?= htmlspecialchars($article['title']) ?>
                            </a>
                        </h2>
                        <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                        <p class="text-muted">
                            Posted on: <?= date('F j, Y', strtotime($article['created_at'])) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Parents in Sync. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>