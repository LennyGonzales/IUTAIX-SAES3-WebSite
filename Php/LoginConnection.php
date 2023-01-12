<?php
session_start();

require 'connectionSQL.php';

if (isset($_POST['email'], $_POST['user_password'])){
    $email = stripslashes($_POST['email']);
    $user_password = stripslashes($_POST['user_password']);

    $stmt = $con->prepare("SELECT * FROM USERS WHERE email=:email AND user_password=:user_password");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':user_password', hash('sha512', $user_password), PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $user = $result;
        // Verify if a user is an admin or a simple user
        $_SESSION['user'] = $user;
        $_SESSION['connected'] = true;
        header('location: ./pages/accueilPage.php');
    }

    else{
        echo "<h1>Le nom d'utilisateur ou le mot de passe est incorrect.</h1>";
        header('refresh:1; url= ./pages/loginPage.php');
    }
}