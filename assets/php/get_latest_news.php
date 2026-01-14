<?php
include './config.php';

try {
    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $req = $bdd->prepare("
  SELECT 
        n.news_id,
        n.title,
        n.slug,
        n.main_image,
        n.published_at,
        n.views,
        c.category_name
    FROM news n
    LEFT JOIN news_categories c 
        ON n.category_id = c.id_category
    WHERE n.status = 'Publié'
    ORDER BY n.published_at DESC
    LIMIT 4
    ");

    $req->execute();
    $news = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $news
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
