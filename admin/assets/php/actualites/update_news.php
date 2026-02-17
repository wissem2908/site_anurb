<?php
include '../config.php';

try {

    $bdd = new PDO(
        "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    /* =========================
       1. Validation
    ========================= */
    if (
        empty($_POST['id']) ||
        empty($_POST['title']) ||
        empty($_POST['description']) ||
        empty($_POST['category']) ||
        empty($_POST['status']) ||
        empty($_POST['published_at'])
    ) {
        throw new Exception('Champs obligatoires manquants');
    }

    $newsId = (int) $_POST['id'];

    /* =========================
       2. Slug
    ========================= */
    function slugify($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    $slug = slugify($_POST['title']);

    /* =========================
       3. Main image (optional)
    ========================= */
$uploadDir = '../../uploads/news/';
$mainImageName = null;

if (!empty($_FILES['main_image']['name'])) {

    // 1️⃣ Get current main image from DB
    $stmt = $bdd->prepare("SELECT main_image FROM news WHERE news_id = :id");
    $stmt->execute(['id' => $newsId]);
    $current = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($current && !empty($current['main_image'])) {
        $oldImagePath = $uploadDir . $current['main_image'];
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath); // delete old file
        }
    }

    // 2️⃣ Save new main image
    $mainImageName = time() . '_' . basename($_FILES['main_image']['name']);
    $mainImagePath = $uploadDir . $mainImageName;

    if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $mainImagePath)) {
        throw new Exception('Erreur upload image principale');
    }

    // 3️⃣ Update DB with new main image
    $req = $bdd->prepare("
        UPDATE news SET
            title = :title,
            slug = :slug,
            description = :description,
            featured = :featured,
            main_image = :main_image,
            category_id = :category_id,
            published_at = :published_at,
            status = :status,
            updated_at = NOW()
        WHERE news_id = :id
    ");

    $req->execute([
        'title'        => $_POST['title'],
        'slug'         => $slug,
        'description'  => $_POST['description'],
        'featured'     => (int) $_POST['featured'],
        'main_image'   => $mainImageName,
        'category_id'  => $_POST['category'],
        'published_at' => $_POST['published_at'],
        'status'       => $_POST['status'],
        'id'           => $newsId
    ]);

} else {

    // update without changing image
    $req = $bdd->prepare("
        UPDATE news SET
            title = :title,
            slug = :slug,
            description = :description,
            featured = :featured,
            category_id = :category_id,
            published_at = :published_at,
            status = :status,
            updated_at = NOW()
        WHERE news_id = :id
    ");

    $req->execute([
        'title'        => $_POST['title'],
        'slug'         => $slug,
        'description'  => $_POST['description'],
        'featured'     => (int) $_POST['featured'],
        'category_id'  => $_POST['category'],
        'published_at' => $_POST['published_at'],
        'status'       => $_POST['status'],
        'id'           => $newsId
    ]);
}

    /* =========================
       4. Update gallery images
    ========================= */

    if (!empty($_FILES['images']['name'][0])) {

        foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {

            if (empty($tmpName)) continue;

            $imageName = time() . '_' . $_FILES['images']['name'][$index];
            $imagePath = $uploadDir . $imageName;
            $position  = $_POST['positions'][$index] ?? 0;

            if (move_uploaded_file($tmpName, $imagePath)) {

                $reqImg = $bdd->prepare("
                    INSERT INTO news_images (news_id, image, position)
                    VALUES (:news_id, :image, :position)
                ");

                $reqImg->execute([
                    'news_id' => $newsId,
                    'image'   => $imageName,
                    'position' => (int) $position
                ]);
            }
        }
    }

    /* =========================
       5. Update positions only
    ========================= */
    // if (!empty($_POST['positions'])) {
    //     foreach ($_POST['positions'] as $index => $pos) {

    //         $bdd->prepare("
    //             UPDATE news_images
    //             SET position = :position
    //             WHERE news_id = :news_id
    //             LIMIT 1 OFFSET $index
    //         ")->execute([
    //             'position' => (int)$pos,
    //             'news_id'  => $newsId
    //         ]);
    //     }
    // }

    /* =========================
       6. Update tags
    ========================= */

    // delete existing links
    $bdd->prepare("DELETE FROM news_tags WHERE news_id  = ?")->execute([$newsId]);

     /********************** tags ***************************/
    if (!empty($_POST['tags'])) {

        $tags = explode(',', $_POST['tags']);

        foreach ($tags as $tagName) {

            $tagName = trim($tagName);
            if ($tagName === '') continue;

            // Slugify tag
            $slug = strtolower($tagName);
            $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
            $slug = trim($slug, '-');

            // Check if tag exists
            $req = $bdd->prepare("
            SELECT tag_id FROM tags WHERE slug = :slug
        ");
            $req->execute(['slug' => $slug]);
            $tag = $req->fetch(PDO::FETCH_ASSOC);

            if ($tag) {
                $tagId = $tag['tag_id'];
            } else {
                // Insert new tag
                $insert = $bdd->prepare("
                INSERT INTO tags (name, slug)
                VALUES (:name, :slug)
            ");
                $insert->execute([
                    'name' => $tagName,
                    'slug' => $slug
                ]);
                $tagId = $bdd->lastInsertId();
            }

            // Link tag to news
            $link = $bdd->prepare("
            INSERT IGNORE INTO news_tags (news_id, tag_id)
            VALUES (:news_id, :tag_id)
        ");
            $link->execute([
                'news_id' => $newsId,
                'tag_id'  => $tagId
            ]);
        }
    }
    echo json_encode([
        'success' => true,
        'news_id' => $newsId
    ]);
} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'error'   => $e->getMessage()
    ]);
}
