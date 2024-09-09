<?php

// require '/home/dev4/www/CDPI-CANNES-GRP1/Articles/Conditions-PHP/conditions.php';
require 'database.php';

var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "post recieve";
    if(isset($_POST['submit'])) {
        try {
        $sql = "INSERT INTO articles (title, first_text, main_text, user_id, category_id ) 
        VALUES (:title, :first_text, :main_text, :user_id, :category_id)";
    
        $stmt = $pdo->prepare($sql);
            echo "pdo prepare";
        $stmt->execute([
            "title" =>  $_POST["title"],
            "first_text" =>  $_POST["first_text"],
            "main_text" =>  $_POST["main_text"],
            "user_id" =>  1,
            "category_id" =>  $_POST["category_id"],
        ]);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }


    }

}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon article</title> 
    <link rel="stylesheet" href="ajout-article.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="bandit">
            <h1>BANDIT</h1>
            <img src="logo.png" class="logo">
            <h1>PAPERS</h1>
        </div>
    </header>
    <nav>
        <a href="#">Conspirations</a>
        <a href="#">Techno Cachée</a>
        <a href="#">Enquêtes</a>
        <a href="#">Secrets d'État</a>
        <a href="#">Phénomènes Mystérieux</a>
        <a href="#">Corruption</a>
        <a href="#">Crimes d'Élite</a>
    </nav>

    <div class="bloc">
            <form action="envoi.php" method="POST">
                <?php
                    $category_id = [
                        0 => "Choisir Catégorie",
                        1 => "Conspirations",
                        2 => "Techno Cachée",
                        3 => "Secrets d'État",
                        4 => "Phénomènes Mystérieux",
                        5 => "Corruption",
                        6 => "Crimes d'Élite"
                    ];
                ?>

                <label for="title">Titre:</label>
                <input type="text" id="title" name="title"><br>

                <label for="category_id">Catégorie:</label>
                <select name="category_id" >
                    <option value="#">Choisir Catégorie</option>
                    <option value="1" id="1">Conspirations</option>
                    <option value="2" id="2">Techno Cachée </option>
                    <option value="3" id="3">Secrets d'État </option>
                    <option value="4" id="4">Phénomènes Mystérieux</option>
                    <option value="5" id="5">Corruption</option>
                    <option value="6" id="6">Crimes d'Élite</option>
                </select><br>


                <label for="first_text">Descriptif :</label>
                <input type="text" id="first_text" name="first_text" ><br>


                <label for="main_text">Description :</label><br>
                <textarea id="main_text" name="main_text"></textarea><br>

                <label for="user_id">user_id</label>
                <input type="number" id="user_id" name="user_id"><br>
                <!--<label for="date">Date de début:</label>
                <input type="date" id="posting_date" name="posting_date" required><br>
            
                <label for="date">Date de fin:</label>
                <input type="date" id="ending_date" name="ending_date" required><br>-->
                <button type="submit" class="button2">Poster</button>
            </form>
                <!--<div class="importation">
                    <p>Importation d'image</p>
                    <img src="Vector.svg">
                    <button type="submit" class="button2">Soumettre</button>-->
                </div>
    </div>
</body>
</html>