<?php

// Définition des informations de connexion à la base de données
$host = "peanut.db.elephantsql.com";
$user = "lhnhqbrm";
$pass = "KWjwsNe0T5pXCtXHh5M3tXy_ppanNir4";
$db = "lhnhqbrm";

// Tentative de connexion à la base de données
try { 
    $con = new PDO("pgsql:host=$host;dbname=$db", $user, $pass); 
} 
// En cas d'erreur, affichage d'un message d'erreur
catch (PDOException $e) { 
    die("Erreur !: " . $e->getMessage());
}

?>
