<?php


include '../config.php';

try {
    // Connection to the database
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    $req = $bdd->prepare('SELECT * from news_tags left join tags on news_tags.tag_id  = tags.tag_id  where news_id = ?');
    $res = $req->execute(array($_POST['id']));


    $output = [];
    while ($res = $req->fetch(PDO::FETCH_ASSOC)) {
        $output[] = $res;
    } //fin while
    echo json_encode($output);
 

 



} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}