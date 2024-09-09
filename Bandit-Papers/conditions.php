<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//<?php echo $errors['password'];


require 'database.php';

session_start();


function Titre($title, $first_text, $category,$pdo){
    if (empty($title)) {
        return "Le titre ne peut pas être vide.";
    }
    

    if (strlen($title) > 80) {
        return "Le titre ne peut excéder 80 caractères.";   
    }
    

    if (strlen($first_text) > 300) {
        return "Le contenu de votre article ne peut dépasser les 300 caractères";
    }

    return null;

}

function AjoutArticle($title, $category, $first_text, $main_text, $pdo) {
    $sql = "INSERT INTO articles (title, category_id, first_text, main_text) VALUES (:title, :category, :first_text, :main_text)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':category' => $category,
        ':first-text' => $first_text,
        'main_text' => $main_text
        
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? ''; 
    $category = $_POST['category'] ?? '';
    $first_text = $_POST['first_text'] ?? '';
    $main_text = $_POST['main_text'] ?? '';

    $error = Titre($title, $first_text, $category, $pdo);
    if ($error) {
        header("Location: form.html?error=" . urlencode($error));
        exit();
    }

    AjoutArticle($_POST['title'], $_POST['category'],  $_POST['first_text'], $_POST['main_text'], $pdo);

    header("Location: form.html?success=" . urlencode("L'article a été ajouté avec succès."));
    exit();
}

?>
