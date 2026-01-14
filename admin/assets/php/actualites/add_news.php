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
       1. Basic validation
       ========================= */
    if (
        empty($_POST['title']) ||
        empty($_POST['description']) ||
        empty($_POST['category']) ||
        empty($_POST['status']) ||
        empty($_POST['published_at']) ||
        empty($_FILES['main_image']['name'])
    ) {
        throw new Exception('Champs obligatoires manquants');
    }

    /* =========================
       2. Generate slug
       ========================= */
    function slugify($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    $slug = slugify($_POST['title']);

    /* =========================
       3. Upload main image
       ========================= */
    $uploadDir = '../../uploads/news/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $mainImageName = time() . '_' . basename($_FILES['main_image']['name']);
    $mainImagePath = $uploadDir . $mainImageName;

    if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $mainImagePath)) {
        throw new Exception('Erreur upload image principale');
    }

    /* =========================
       4. Insert news
       ========================= */

    // Example: author id from session (adjust if needed)
    session_start();
    $authorId = $_SESSION['user_id'] ?? 1;

    $req = $bdd->prepare("
        INSERT INTO news (
            title,
            slug,
            description,
            featured,
            main_image,
            author_id,
            category_id,
            published_at,
            status,
            views,
            created_at
        ) VALUES (
            :title,
            :slug,
            :description,
            :featured,
            :main_image,
            :author_id,
            :category_id,
            :published_at,
            :status,
            0,
            NOW()
        )
    ");

    $req->execute([
        'title'        => $_POST['title'],
        'slug'         => $slug,
        'description'  => $_POST['description'],
        'featured'     => (int) $_POST['featured'],
        'main_image'   => $mainImageName,
        'author_id'    => $authorId,
        'category_id'  => $_POST['category'],
        'published_at' => $_POST['published_at'],
        'status'       => $_POST['status']
    ]);

    $newsId = $bdd->lastInsertId();

    /* =========================
       5. Insert additional images (optional)
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
                    'position'=> (int) $position
                ]);
            }
        }
    }


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
