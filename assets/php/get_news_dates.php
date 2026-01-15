<?php
include './config.php';

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $req = $bdd->query("
        SELECT DISTINCT DATE(published_at) AS news_date
        FROM news
        WHERE TRIM(status) = 'Publié'
          AND published_at IS NOT NULL
    ");

    $dates = $req->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode($dates);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
