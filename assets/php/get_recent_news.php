<?php
include './config.php';

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $bdd->prepare("
        SELECT title, slug, main_image, DATE_FORMAT(published_at, '%Y-%m-%d') AS published_at
        FROM news
        WHERE status = 'Publié'
        ORDER BY published_at DESC
    ");
    $stmt->execute();

    $recentNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($recentNews);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
