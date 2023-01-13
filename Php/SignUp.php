<?php
require('connectionSQL.php');

// Vérifie si les champs "email" et "user_password" ont été remplis dans le formulaire
if (isset($_REQUEST['email'], $_REQUEST['user_password'])){
    try {
        // Enlève les caractères d'échappement des données saisies dans le formulaire
        $email2 = stripslashes($_REQUEST['email']);
        $user_password2 = stripslashes($_REQUEST['user_password']);

        // Vérifie si l'email saisi est déjà utilisé dans la base de données
        $check_email_run = $con->prepare("SELECT EMAIL FROM USERS WHERE EMAIL = ?");
        $check_email_run->execute([$email2]);
        if ($check_email_run->rowCount() > 0) {
            echo "Ce mail est déja utilisé.";
        } else {
            if (substr($email2, -16, 16) == "@etu.univ-amu.fr" || substr($email2, -12, 12) == "@univ-amu.fr") {
                // Vérifie si le mot de passe contient 12 caractères, au moins une majuscule et un caractère spécial
                if (strlen($user_password2) < 12) {
                    echo "<h3>Le mot de passe doit comporter 12 caractères.</h3>";
                    header("refresh:1; url=pages/loginPage.php");
                } 
                elseif (!preg_match('/[A-Z]/', $user_password2)) {
                    echo "<h3>Le mot de passe doit contenir au moins une majuscule.</h3>";
                    header("refresh:1; url=pages/loginPage.php");
                } 
                elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user_password2)){
                    echo "<h3>Le mot de passe doit contenir un caractère spécial.</h3>";
                    header("refresh:1; url=pages/loginPage.php");  
                }
                
            else {
                // Insertion des données dans la base de données
                $query = $con->prepare("INSERT into USERS (EMAIL, USER_PASSWORD) VALUES (?, ?)");
                $res = $query->execute([$email2, hash('sha512', $user_password2)]);
                if($res){
                    echo "<div class='sucess'>
                    <h3>Vous êtes inscrit avec succès.</h3>
                    <p>Cliquez ici pour vous <a href='connectionPage.php'>connecter</a></p>
                    </div>";
                    header("refresh:1; url=pages/loginPage.php");
                    } 
                else{
                    error_reporting(0);
                    echo "<h3>Veuillez mettre une adresse mail amu valide.</h3>
                    </div>";
                    error_reporting(0);
                    header("refresh:1; url=pages/loginPage.php");
                    }
                }
            }
        }
    } 
    catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    }

}

