<?php


include '../config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    $req = $bdd->prepare('SELECT *,news.created_at as news_date_creation FROM `news`  left join news_categories on news.category_id  = news_categories.id_category left join users on news.author_id = users.id_user  where news_id = ?');
    $res = $req->execute(array($_POST['id']));


$res = $req->fetch(PDO::FETCH_ASSOC);
   
    echo json_encode($res);
 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}