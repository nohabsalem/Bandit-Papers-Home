<?php
require 'database.php';

$title = $_POST["title"];
$first_text = $_POST["first_text"];
$main_text = $_POST["main_text"];
$user_id = 1;
$category_id = $_POST["category_id"] ?? null;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection établie avec succès.";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Requête d'insertion avec la date du jour
$sql = "INSERT INTO articles (title, first_text, main_text, user_id, category_id) 
        VALUES (:title, :first_text, :main_text, :user_id, :category_id,)";

try {
    $sth = $conn->prepare($sql);
    $sth->bindParam(':title', $title, PDO::PARAM_STR);
    $sth->bindParam(':first_text', $first_text, PDO::PARAM_STR);
    $sth->bindParam(':main_text', $main_text, PDO::PARAM_STR);
    $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $sth->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $sth->execute();
    echo "Les données ont été insérées avec succès.";
} catch (PDOException $e) {
    echo 'Erreur ' . $e->getMessage();
}
?>
