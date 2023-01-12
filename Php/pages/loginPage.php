<?php
    // Initialisation de la session
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/login-style.css">
    <title>NetWork Stories Login</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../LoginCreation.php" method="POST">
                <h1>Créer un compte</h1>
                <input type="text" class="box-input" name="email" placeholder="Email" required />  
                <input type="password" class="box-input" name="user_password" placeholder="Mots de passe" required />            
                <input type="checkbox"  name="terms" id="terms" required>
                <label for="terms" style="font-size: 0.6em">J'accepte les conditions générales d'utilisation</label>
                <br>
                <input type="submit" name="inscription" value="S'inscrire" class="box-button" onclick="$res" />          
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../LoginConnection.php" method="POST">
                <h1>Connexion</h1>
                <input type="text" class="box-input" name="email" placeholder="Email"/>
                <input type="password" class="box-input" name="user_password" placeholder="Mot de passe"/>
                <a href="#">Mot de passe oublié?</a>
                <input type="submit" value="Connexion " name="connexion" class="box-button"/>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Re bonjour !</h1>
                    <p>Connecte-toi pour commencer.</p>
                    <button class="ghost"id="signIn">Connexion</button>
        </div>
        <div class="overlay-panel overlay-right">
        <h1>Bienvenue !</h1>
        <p>Crée un compte pour rester connecté.</p>
        <button class="ghost" id="signUp">Créer un compte</button>
        </div>
        </div>
        </div>
        </div>
        <script src="../../Js/login.js"></script>

</body>
</html>
