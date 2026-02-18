<?php
include '../config.php';
header('Content-Type: application/json');

if (empty($_POST['id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$id = (int) $_POST['id'];


$bdd = new PDO(
    "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4",
    DB_USER,
    DB_PASS,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// 1) Check if image exists
$stmt = $bdd->prepare("SELECT image FROM news_images WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$image) {
    echo json_encode(['success' => false, 'message' => 'Image not found']);
    exit;
}

// 2) Delete from DB
$delete = $bdd->prepare("DELETE FROM news_images WHERE id = ?");
$delete->execute([$id]);

// 3) Delete file from server
$filePath = '../../uploads/news/' . $image['image'];
if (file_exists($filePath)) {
    unlink($filePath);
}

echo json_encode(['success' => "true"]);
