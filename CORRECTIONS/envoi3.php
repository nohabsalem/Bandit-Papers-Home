<?php
require 'database.php';

$title = $_POST["title"] ?? '';
$first_text = $_POST["first_text"] ?? '';
$main_text = $_POST["main_text"] ?? '';
$user_id = $_POST["user_id"] ?? null;
$category_id = $_POST["category_id"] ?? null;
$posting_date = $_POST["posting_date"] ?? date('Y-m-d');
$ending_date = $_POST["ending_date"] ?? date('Y-m-d');
$errors = [];

var_dump($_POST);

if (empty($title)) {
    $errors[] = "Le titre ne peut pas être vide.";
} elseif (strlen($title) > 80) {
    $errors[] = "Le titre ne peut excéder 80 caractères.";
}

if (strlen($first_text) > 300) {
    $errors[] = "Le contenu de votre article ne peut dépasser les 300 caractères.";
}

if (empty($main_text)) {
    $errors[] = "Le contenu de votre article ne peut être vide.";
}

if (empty($category_id)) {
    $errors[] = "La catégorie ne peut pas être vide.";
}

if (empty($posting_date)) {
    $errors[] = "La date de publication ne peut pas être vide.";
}

if (empty($ending_date)) {
    $errors[] = "La date de fin publication ne peut pas être vide.";
}
if ($posting_date>$ending_date){
    $errors[] = "La date de publication ne peut pas être supérieure à la date";
}

// Si des erreurs existent, afficher les erreurs et arrêter l'exécution
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    exit;
}

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO articles (title, first_text, main_text, user_id, category_id, posting_date, ending_date)
            VALUES (:title, :first_text, :main_text, :user_id, :category_id, :posting_date, :ending_date)";

    $sth = $conn->prepare($sql);
    $sth->bindParam(':title', $title, PDO::PARAM_STR);
    $sth->bindParam(':first_text', $first_text, PDO::PARAM_STR);
    $sth->bindParam(':main_text', $main_text, PDO::PARAM_STR);
    $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $sth->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $sth->bindParam(':posting_date', $posting_date, PDO::PARAM_STR);
    $sth->bindParam(':ending_date', $ending_date, PDO::PARAM_STR);
    $sth->execute();

    echo "Félicitations ! Votre article a bien été enregistré.";
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
