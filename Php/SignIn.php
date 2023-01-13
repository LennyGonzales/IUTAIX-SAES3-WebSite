<?php
// démarrer une session pour stocker des données d'utilisateu
session_start(); 
// importer la connexion à la base de données
require 'connectionSQL.php'; 

// vérifier si les données de connexion ont été postées
if (isset($_POST['email'], $_POST['user_password'])){ 

    // nettoyer l'email de l'utilisateur
    $email = stripslashes($_POST['email']); 

    // nettoyer le mot de passe de l'utilisateur
    $user_password = stripslashes($_POST['user_password']); 

    // préparer une requête pour récupérer les informations de l'utilisateur correspondant à l'email et au mot de passe donnés
    $stmt = $con->prepare("SELECT * FROM USERS WHERE email=:email AND user_password=:user_password"); 

    // lier la variable email à la requête
    $stmt->bindValue(':email', $email, PDO::PARAM_STR); 
    // lier la variable user_password à la requête
    $stmt->bindValue(':user_password', hash('sha512', $user_password), PDO::PARAM_STR); 
    // exécuter la requête
    $stmt->execute(); 
    // récupérer les informations de l'utilisateur dans un tableau associatif
    $result = $stmt->fetch(PDO::FETCH_ASSOC); 

    // si les informations de l'utilisateur ont été récupérées
    if ($result) {
        $user = $result;
        // stocker les informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;
        // indiquer que l'utilisateur est connecté
        $_SESSION['connected'] = true;
        // rediriger vers la page d'accueil
        header('location: ./pages/accueilPage.php'); 
    }
    else{
        echo "<h1>Le nom d'utilisateur ou le mot de passe est incorrect.</h1>";
        header('Location: ./pages/loginPage.php?error=true');
    }
}
?>