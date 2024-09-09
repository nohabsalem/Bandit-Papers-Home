<?php
$host= "136.243.172.164";
$port= '30005';
 $dbname= "cdpi_groupe1_dev2";
 $username= "cdpi_groupe1_dev2";
$password= "cdpi_groupe1_dev2";

try {
// Création de la connexion PDO
 $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
 $pdo = new PDO($dsn, $username, $password);

// Configuration des options PDO
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

 echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {

 echo "Erreur : Votre article ,'a pu être ajouté. : " . $e->getMessage();
}
?>