<?php
require_once 'includes/config.php';
require_once 'article_handler.php';

$articleHandler = new ArticleHandler($db_config);
$featuredArticles = $articleHandler->getFeaturedArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Parents in Sync</title>

    <style>
        .custom-navbar {
            background-color: #0fd0fb;
        }

        .footer {
            background-color: #0fd0fb;
        }
        main {
            min-height: 98vh;
        }
    </style>
</head>
<body>
    <main>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container">
                <a class="navbar-brand" href="#">Parents in Sync</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <a class="nav-link" href="about.php">About Us</a>
                        <a class="nav-link" href="forum.php">Forum</a>
                        <a class="nav-link" href="resources.php">Resources</a>
                    </div>
                </div>
            </div>
        </nav> <br>
        <section class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                <h1 class="card-title text-center">Welcome to Parents in Sync.</h1> <br>
                <h4 class="card-text text-center">
                    Parents in Sync is a supportive community where new parents can connect, share their experiences, and access valuable resources. 
                    Whether you're seeking advice, looking to share your journey, or finding reliable information, this is the place to be. 
                    Our forum is open to both moms and dads, providing a space where every voice matters.</h4> <br>
                <div class="text-center">
                    <a href="forum.php" class="btn btn-primary btn-lg">Join the Discussion</a>
                </div>              
                </div>
            </div>
        </section>
        <section class="container mt-5">
            <div class="container py-5">
                <h1 class="text-center mb-4">Featured Latest Threads</h1> 
                
                <div class="row g-4">
                    <!-- First Card -->
                    <?php foreach ($featuredArticles as $article): ?>
                    <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                        <?php if ($article['image_path']): ?>
                            <img src="<?php echo htmlspecialchars($article['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article['title']); ?>">
                        <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title h5"><?php echo htmlspecialchars($article['title']); ?></h2>
                                <p class="card-text"><?php echo htmlspecialchars($article['summary']); ?></p>
                                <a href="article.php?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="text-decoration-none text-primary">Read more</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!-- Second Card
                    <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="images/image.png" class="card-img-top" alt="Image description">
                            <div class="card-body">
                                <h2 class="card-title h5">Decoding Your Baby's Cries: A Guide to Understanding and Responding</h2>
                                <p class="card-text">Learn about different types of baby cries, common causes, and effective ways to soothe and comfort your little one.</p>
                                <a href="article.php?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="text-decoration-none text-primary">Read more</a>
                            </div>
                        </div>
                    </div> -->
        
                    <!-- Third Card -->
                    <!-- <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="images/image.png" class="card-img-top" alt="Image description">
                            <div class="card-body">
                                <h2 class="card-title h5">Navigating Postpartum Depression: A Guide to Seeking Help and Finding Support</h2>
                                <p class="card-text">Learn about postpartum depression, its symptoms, and how to seek professional help. Connect with other parents who understand.</p>
                                <a href="article.php?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="text-decoration-none text-primary">Read more</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </main>
</body> 
<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light footer">
    <div class="container">
        <div class="text-center">
            <p class="text-muted mb-0">&copy; 2024 Parents in Sync. All rights reserved.</p>
        </div>
    </div>
</footer>
</html>
