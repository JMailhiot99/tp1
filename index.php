<?php

$host = "localhost";
$db = "jmailhiot_tp1";
$user = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $oPDO = new PDO($dsn, $user, $password);

    if ($oPDO) {
        echo "Connected to the $db database successfully!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


// Inclure les fichiers des classes
require_once './class/CRUD.php';
require_once './class/jeu.php';

// Informations de connexion à la base de données MySQL
$host = 'localhost';
$db = 'jmailhiot_tp1';
$user = 'root';
$password = '';

// Création d'une instance de la classe jeu
$jeuOperator = new Jeu($host, $db, $user, $password);

//Montrer tous les items contenus dans la db
$jeux = $jeuOperator->getJeux();
foreach ($jeux as $jeu) {
    echo "ID: {$jeu['id']}, Nom: {$jeu['nom']}, Année de lancement: {$jeu['annee_lancement']}, Genre: {$jeu['genre']}, Prix: {$jeu['prix']}<br>";
}

//Montrer un item en le sélectionnant avec son id
$jeuById = $jeuOperator->getJeuById(1);

print_r($jeuById);

//Ajouter un jeu
$newJeuData = [
    'nom' => 'StarField',
    'annee_lancement' => 2023,
    'genre' => 'RPG/Aventure',
    'prix' => 90
];

echo "<br><br>";

$jeuOperator->ajouterJeu($newJeuData);
echo "Votre nouveau jeu a été ajouté<br>";

//Modifier un jeu
$idToEdit = 2;
$updatedJeuData = [
    'prix' => 60
];

$jeuOperator->UpdateJeuById($idToEdit, $updatedJeuData);
echo "Jeu avec le ID : $idToEdit modifié avec succès<br>";

// Supprimer un jeu
$idToDelete = 3;
$jeuOperator->deleteJeu($idToDelete);
echo "Jeu avec le ID : $idToDelete supprimé avec succès<br>";

// Fermer la connexion à la base de données
unset($jeuManager);
?>