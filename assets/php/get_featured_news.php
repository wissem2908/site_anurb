<?php
include './config.php';

try {
    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Get the latest featured news
    $req = $bdd->prepare("
        SELECT news_id, title, slug, description, main_image, published_at
        FROM news
        WHERE featured = 1 AND status = 'Publié'
        ORDER BY published_at DESC
        LIMIT 1
    ");
    $req->execute();
    $news = $req->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'news' => $news]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
