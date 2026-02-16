<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

try {
    $bdd = new PDO(
        "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    /* =========================
       1. Validation
       ========================= */
    if (empty($_POST['id'])) {
        throw new Exception('ID manquant');
    }

    $newsId = (int) $_POST['id'];

    /* =========================
       2. Start transaction
       ========================= */
    $bdd->beginTransaction();

    /* =========================
       3. Get main image
       ========================= */
    $req = $bdd->prepare("SELECT main_image FROM news WHERE news_id  = ?");
    $req->execute([$newsId]);
    $news = $req->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        throw new Exception('News introuvable');
    }

    $uploadDir = '../../uploads/news/';

    // Delete main image file
    if (!empty($news['main_image'])) {
        $mainImagePath = $uploadDir . $news['main_image'];
        if (file_exists($mainImagePath)) {
            unlink($mainImagePath);
        }
    }

    /* =========================
       4. Delete additional images
       ========================= */
    $reqImgs = $bdd->prepare("SELECT image FROM news_images WHERE news_id = ?");
    $reqImgs->execute([$newsId]);

    while ($img = $reqImgs->fetch(PDO::FETCH_ASSOC)) {
        $imgPath = $uploadDir . $img['image'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
    }

    // Remove from DB
    $bdd->prepare("DELETE FROM news_images WHERE news_id = ?")->execute([$newsId]);

    /* =========================
       5. Delete tag relations
       ========================= */
    $bdd->prepare("DELETE FROM news_tags WHERE news_id = ?")->execute([$newsId]);

    /* =========================
       6. Delete news
       ========================= */
    $bdd->prepare("DELETE FROM news WHERE news_id  = ?")->execute([$newsId]);

    /* =========================
       7. Commit
       ========================= */
    $bdd->commit();

    echo json_encode([
        'success' => true
    ]);

} catch (Exception $e) {

    if (isset($bdd) && $bdd->inTransaction()) {
        $bdd->rollBack();
    }

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => $e->getMessage()
    ]);
}
