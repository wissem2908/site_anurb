<?php
include './config.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($q)) {
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
    SELECT news_id, title, slug, main_image, DATE_FORMAT(published_at, '%Y-%m-%d') AS published_at
    FROM news
    WHERE status = 'Publié' AND title LIKE ?
    ORDER BY published_at DESC
    LIMIT 10
");

$searchTerm = "%$q%";
$req->execute([$searchTerm]);

$results = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

}
 catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
