<?php
require 'database.php';

$title = $_POST["title"];
$first_text = $_POST["first_text"];
$main_text = $_POST["main_text"];
$user_id = $_POST["user_id"] ?? null;
$category_id = $_POST["category_id"] ?? null;
$posting_date = date('Y-m-d');
$ending_date = date('Y-m-d');
$errors = [];

try {
    $conn = new PDO ("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}

$sql = "INSERT INTO articles (title, first_text, main_text, user_id, category_id, posting_date, ending_date)
        VALUES (:title, :first_text, :main_text, :user_id, :category_id, :posting_date, :ending_date)";

    try{
        $sth = $conn->prepare($sql);
        $sth->bindParam(':title', $title, PDO::PARAM_STR);
        $sth->bindParam(':first_text', $first_text, PDO::PARAM_STR);
        $sth->bindParam(':main_text', $main_text, PDO::PARAM_STR);
        $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $sth->bindParam(':posting_date', $posting_date, PDO::PARAM_STR);
        $sth->bindParam(':ending_date', $ending_date, PDO::PARAM_STR);
        $sth->execute();
        echo " Félicitations ! 
        Votre article a bien été enregistré.";
    } catch (PDOException $e){
        echo 'error' . $e->getMessage();
    }