<?php
include './config.php';

$date = $_GET['date'] ?? '';

if (!$date) {
    echo json_encode([]);
    exit;
}

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $req = $bdd->prepare("
        SELECT
            title,
            slug,
            main_image,
            DATE(published_at) AS pub_date
        FROM news
        WHERE TRIM(status) = 'Publié'
          AND DATE(published_at) = ?
        ORDER BY published_at DESC
    ");

    $req->execute([$date]);
    $newsList = $req->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($newsList);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
