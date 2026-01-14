<?php
include './config.php';

if (!isset($_GET['slug'])) {
    http_response_code(400);
    echo json_encode([]);
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

    // Get the category of the current news
    $stmt = $bdd->prepare("SELECT category_id FROM news WHERE slug = :slug LIMIT 1");
    $stmt->execute(['slug' => $slug]);
    $currentNews = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$currentNews) {
        echo json_encode([]);
        exit;
    }

    $categoryId = $currentNews['category_id'];

    // Get related news from the same category, excluding current news
    $stmt2 = $bdd->prepare("
        SELECT title, slug, main_image, DATE_FORMAT(published_at, '%d-%m-%Y') AS published_at
        FROM news
        WHERE category_id = :category_id
        AND slug != :slug
        AND status = 'Publié'
        ORDER BY published_at DESC
        LIMIT 5
    ");
    $stmt2->execute([
        'category_id' => $categoryId,
        'slug' => $slug
    ]);

    $relatedNews = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($relatedNews);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
