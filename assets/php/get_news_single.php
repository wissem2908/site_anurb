<?php
include './config.php';

$slug = $_GET['slug'] ?? null;

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // 1. Get article (by slug OR latest)
    if ($slug) {
        $stmt = $bdd->prepare("
            SELECT n.news_id, n.title, n.description, n.published_at, n.main_image, n.views,
                   c.category_name, u.username AS author_name
            FROM news n
            LEFT JOIN news_categories c ON n.category_id = c.id_category
            LEFT JOIN users u ON n.author_id = u.id_user
            WHERE n.slug = :slug AND n.status = 'Publié'
            LIMIT 1
        ");
        $stmt->execute(['slug' => $slug]);
    } else {
        $stmt = $bdd->query("
            SELECT n.news_id, n.title, n.description, n.published_at, n.main_image, n.views,
                   c.category_name, u.username AS author_name
            FROM news n
            LEFT JOIN news_categories c ON n.category_id = c.id_category
            LEFT JOIN users u ON n.author_id = u.id_user
            WHERE n.status = 'Publié'
            ORDER BY n.published_at DESC
            LIMIT 1
        ");
    }

    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        echo json_encode(null);
        exit;
    }

    // 2. Increment views (SERVER SIDE)
    $update = $bdd->prepare("
        UPDATE news SET views = views + 1 WHERE news_id = ?
    ");
    $update->execute([$news['news_id']]);

    // 3. Fetch images
    $stmt2 = $bdd->prepare("
        SELECT image 
        FROM news_images 
        WHERE news_id = ?
        ORDER BY position ASC
    ");
    $stmt2->execute([$news['news_id']]);
    $images = $stmt2->fetchAll(PDO::FETCH_COLUMN);

    array_unshift($images, $news['main_image']);
    $news['images'] = $images;

    echo json_encode($news);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
