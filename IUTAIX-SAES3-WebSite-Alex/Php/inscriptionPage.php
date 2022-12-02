<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css" />
    <title>Inscription</title>
  </head>
  <body>
  <?php
  require('./connectionSQL.php');

  if (isset($_REQUEST['email'], $_REQUEST['user_password'])){
    $email = stripslashes($_REQUEST['email']);
    $email = pg_escape_string($con, $email);
    
    $user_password = stripslashes($_REQUEST['user_password']);
    $user_password = pg_escape_string($con, $user_password);

    $check_email_run = pg_query($con,"SELECT EMAIL FROM USERS AS U WHERE U.EMAIL='$email'");
    if ($check_email_run == 1) {
      echo "Ce mail est déja utilisé.";
      }else{
      if (substr($email, -16,16) == "@etu.univ-amu.fr" OR substr($email, -12, 12) == "@univ-amu.fr"){
        $query = "INSERT into USERS (EMAIL, USER_PASSWORD) VALUES ('$email', '" . hash('sha512', $user_password) . "')";
        $check_email_run = pg_query($con,"SELECT EMAIL FROM USERS AS U WHERE U.EMAIL='$email'");
        $res = pg_query($con, $query);
        if($res){
          echo "<div class='sucess'>
                <h3>Vous êtes inscrit avec succès.</h3>
                <p>Cliquez ici pour vous <a href='connectionPage.php'>connecter</a></p>
                </div>";
                header("refresh:1; url=connectionPage.php");

        }else{
          echo "<h3>Veuillez mettre une adresse mail amu valide.</h3>
                <p>Cliquez ici pour vous <a href='inscriptionPage.php'>réinscrire</a></p>
                </div>";
                header("refresh:1; url=inscriptionPage.php");

        }   
      } 
    }
        

  }else{
  ?>
  <form action="../Html/navBar.php">
    <input type="submit" value="Acceuil">
  </form>
  <form class="box" action="" method="post">
    <h1 class="box-logo box-title"> </h1>
      <h1 class="box-title">Inscription</h1>

    <input type="text" class="box-input" name="email" 
    placeholder="Mail" required />  

      <input type="text" class="box-input" name="user_password" 
    placeholder="Mots de passe" required />

      <input type="submit" name="submit" 
    value="S'inscrire" class="box-button" onclick="$res" />
    
      <p class="box-register">Déjà inscrit? 
    <a href="connectionPage.php">Connectez-vous ici</a></p>
  </form>
  <?php } ?>
</html>