<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css" />
  <title>Connexion</title>
</head>
<body>
<?php
require('connectionSQL.php');
session_start();

if (isset($_POST['email'])){
  $email = stripslashes($_REQUEST['email']);
  $email = pg_escape_string($con, $email);
  $_SESSION['email'] = $email;
  $user_password = stripslashes($_REQUEST['user_password']);
  $user_password = pg_escape_string($con, $user_password);
    $query = "SELECT * FROM USERS WHERE email='$email' 
  and user_password='".hash('sha512', $user_password)."'";
  
  $result = pg_query($con,$query) or die(pg_last_error($conn=null));
  
  if (pg_num_rows($result) == 1) {
    $user = pg_fetch_assoc($result);
    // vérifier si l'utilisateur est un administrateur ou un utilisateur
    if ($user['user_status'] == 'Student') {
      header('location: ../Html/download.html');      
    }else{
      header('location: ./scenario.php');
    }
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>
<form action="../Html/navBar.html">
  <input type="submit" value="Acceuil">
</form>
<form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>        
<input type="text" class="box-input" name="email" placeholder="Email">
<input type="password" class="box-input" name="user_password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? 
  <a href="inscriptionPage.php">S'inscrire</a>
</p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>