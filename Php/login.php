<?php
        session_start();
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/login-style.css">
    <title>NetWork Stories Login</title>
</head>
<body>
  
<?php
    
    require('connectionSQL.php');

    if (isset($_REQUEST['email'], $_REQUEST['user_password'])){
        $email2 = stripslashes($_REQUEST['email']);
        $email2 = pg_escape_string($con, $email2);
        
        $user_password2 = stripslashes($_REQUEST['user_password']);
        $user_password2 = pg_escape_string($con, $user_password2);

        $check_email_run = pg_query($con,"SELECT EMAIL FROM USERS AS U WHERE U.EMAIL='$email2'");
        if (pg_num_rows($check_email_run) == 1) {
        echo "Ce mail est déja utilisé.";
        }else{
            if (substr($email2, -16,16) == "@etu.univ-amu.fr" OR substr($email2, -12, 12) == "@univ-amu.fr"){
                $query = "INSERT into USERS (EMAIL, USER_PASSWORD) VALUES ('$email2', '" . hash('sha512', $user_password2) . "')";
                $res = pg_query($con, $query);
                if($res){
                    echo "<div class='sucess'>
                        <h3>Vous êtes inscrit avec succès.</h3>
                        <p>Cliquez ici pour vous <a href='connectionPage.php'>connecter</a></p>
                        </div>";
                        header("refresh:1; url=login.php");

                }else{
                    error_reporting(0);
                    echo "<h3>Veuillez mettre une adresse mail amu valide.</h3>
                        </div>";
                        error_reporting(0);
                        header("refresh:1; url=login.php");

                }   
            }

        }
    }


    if (isset($_POST['email'], $_POST['user_password'])){
        $email = stripslashes($_REQUEST['email']);
        $email = pg_escape_string($con, $email);
        $_SESSION['email'] = $email;
        $user_password = stripslashes($_REQUEST['user_password']);
        $user_password = pg_escape_string($con, $user_password);
        $query = "SELECT * FROM USERS WHERE email='$email' and user_password='".hash('sha512', $user_password)."'";
        
        $result = pg_query($con,$query) or die(pg_last_error($conn=null));
        
        if (pg_num_rows($result) == 1) {
            $user = pg_fetch_assoc($result);
            // vérifier si l'utilisateur est un administrateur ou un utilisateur
            if ($user['user_status'] == 'Student') {
                $_SESSION['user'] = $user;
                $_SESSION['connected'] = true;
                
                header('location: ./acceuil.php');      
            }else{
                $_SESSION['user'] = $user;
                $_SESSION['connected'] = true;
                
                header('location: ./acceuil.php');
            }
        }else{
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    }

    
    
?>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="POST">
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
            <form action="#" method="POST">
                <h1>Connexion</h1>
                <input type="text" class="box-input" name="email" placeholder="Email"/>
                <input type="password" class="box-input" name="user_password" placeholder="Mot de passe"/>
                <a href="#">Mot de passe oublié?</a>
                <input type="submit" value="Connexion " name="connexion" class="box-button"/>
                <?php 
                if (! empty($message)) { 
                    ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                    <?php 
                } ?>
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
<script src="../Js/login.js"></script>
</body>
</html>