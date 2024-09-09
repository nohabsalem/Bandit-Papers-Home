<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'database.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $title = $_POST["title"] ?? '';
        $first_text = $_POST["first_text"] ?? '';
        $main_text = $_POST["main_text"] ?? '';
        $user_id = $_POST["user_id"] ?? null;
        $category_id = $_POST["category_id"] ?? null;

        // Validation
        if (empty($title)) {
            $errors[] = "Le titre ne peut pas être vide.";
        } elseif (strlen($title) > 80) {
            $errors[] = "Le titre ne peut excéder 80 caractères.";
        }

        if (strlen($first_text) > 300) {
            $errors[] = "Le contenu de votre article ne peut dépasser les 300 caractères.";
        }

        if (empty($category_id)) {
            $errors[] = "La catégorie ne peut pas être vide.";
        }

        if (empty($errors)) {
            try {
                $sql = "INSERT INTO articles (title, first_text, main_text, user_id, category_id) 
                        VALUES (:title, :first_text, :main_text, :user_id, :category_id)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    "title" => $title,
                    "first_text" => $first_text,
                    "main_text" => $main_text,
                    "category_id" => $category_id,
                    "user_id" => $user_id,
                ]);

                // Redirection ou message de succès
                echo "Votre article a bien été enregistré.";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
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
    <link rel="stylesheet" href="article.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="bandit">
        <!-- Section de gauche avec le menu burger -->
        <div class="menu-burger">
            <img src="../image/logo_burger.png" alt="Menu Burger" class="burger-logo">
        </div>

        <!-- Section centrale avec le texte, le logo et le sous-titre -->
        <div class="logo-container">
            <div class="logo-text">
                <h1>BANDIT</h1>
                <img src="logo.png" class="logo">
                <h1>PAPERS</h1>
            </div>
            <p class="subtitle">Journalisme d'Investigation</p>
        </div>

        <!-- Section de droite (vide pour équilibrer) -->
        <div class="right-space"></div>
    </div>
</header>

<nav id="navbar" class="nav-links">
    <a href="#">Ma Planque</a>
    <a href="#">Bidouiller mes Notes</a>
    <a href="#">Les Agents Infiltrés</a>
    <a href="#">Filer en Douce</a>
</nav>

<nav class="nav-catego">
    <ul>
        <li><a href="#">Conspirations</a></li>
        <li><a href="#">Technologies Cachées</a></li>
        <li><a href="#">Secrets d'État</a></li>
        <li><a href="#">Cold Case</a></li>
        <li><a href="#">Corruption</a></li>
        <li><a href="#">Crimes d'Élite</a></li>
    </ul>
</nav>

<div class="bloc">
    <form action="envoi3.php" method="POST">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="envoi2.php" method="POST">
                <?php
                    $category_id = [
                        0 => "Choisir Catégorie",
                        1 => "Conspirations",
                        2 => "Techno Cachée",
                        3 => "Secrets d'État",
                        4 => "Cold Case",
                        5 => "Corruption",
                        6 => "Crimes d'Élite"
                    ];
                ?>

                <label for="title">Titre :</label>
                <input type="text" id="title" name="title">
                <br>

                <label for="category_id" required>Catégorie:</label>
                <select name="category_id" >
                    <option value="#">Choisir Catégorie</option>
                    <option value="1" id="1">Conspirations</option>
                    <option value="2" id="2">Techno Cachée </option>
                    <option value="3" id="3">Secrets d'État </option>
                    <option value="4" id="4">Cold Case</option>
                    <option value="5" id="5">Corruption</option>
                    <option value="6" id="6">Crimes d'Élite</option>
                </select><br>

                <label for="first_text">Descriptif :</label>
                <input type="text" id="first_text" name="first_text">
                <br>

                <label for="main_text">Description :</label><br>
                <textarea id="main_text" name="main_text"></textarea> <br>

                <label for="user_id">user_id</label>    
                <input type="number" id="user_id" name="user_id"><br>

               <label for="date">Date de début:</label>
                <input type="date" id="posting_date" name="posting_date"><br>
                
            
                <label for="date">Date de fin:</label>
                <input type="date" id="ending_date" name="ending_date"><br>
                
                <button type="submit">Poster</button>
            </form>
</div>
</body>
</html>
