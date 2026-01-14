<?php
include './config.php';

if (!isset($_GET['slug'])) {
    http_response_code(400);
    echo json_encode(null);
    exit;
}

$slug = $_GET['slug'];

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Get main news details
    $stmt = $bdd->prepare("
        SELECT n.title, n.description, n.published_at, n.main_image, 
               c.category_name, u.username AS author_name
        FROM news n
        LEFT JOIN news_categories c ON n.category_id = c.id_category
        LEFT JOIN users u ON n.author_id = u.id_user 
        WHERE n.slug = :slug AND n.status = 'Publié'
        LIMIT 1
    ");
    $stmt->execute(['slug' => $slug]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        echo json_encode(null);
        exit;
    }

    // Get additional images
    $stmt2 = $bdd->prepare("SELECT image FROM news_images WHERE news_id = (SELECT news_id FROM news WHERE slug = :slug) ORDER BY position ASC");
    $stmt2->execute(['slug' => $slug]);
    $images = $stmt2->fetchAll(PDO::FETCH_COLUMN);

    // Include main image as first
    array_unshift($images, $news['main_image']);

    $news['images'] = $images;

    echo json_encode($news);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
