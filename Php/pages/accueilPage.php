 <?php
    session_start();
    require '../verifySession.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>NetWork Stories</title>
    <link rel="stylesheet"  type="text/css" href="../../Css/style.css">
    <link rel="icon" href="../../Image/logo-nws.png" type="image/ico" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- navbar sections starts  -->
    
    <header class="header">
        <div class="logo">
            <img src="../../Image/logo-nws.png" alt="logo-nws">
        </div>
        
        <nav class="navbar">
            <a href="accueilPage.php" class="underline">Accueil</a>
            <?php
                if (isset($_SESSION['connected'])){

                    // Vérifiez si l'utilisateur est un administrateur
                    if ($user['user_status'] !== 'Student') {
                        echo '<a href="historyPage.php" class="underline">Histoires</a>';
                    }
                    echo '<a href="deconnection.php" class="btn">Deconnexion</a>';
                }
                else {
                    echo '<a href="loginPage.php" class="btn">Connexion</a>';
                }
            ?>
        </nav>

        <div class="fas fa-bars" id="menu-btn"></div>
    </header>
    <!-- navbar sections starts  -->
    
   
    <!-- home section stars  -->

    <section class="home" id="home">
        <div class="content">
            <h1>NetWork Stories</h1>
            <p>L'objectif de NetWork Stories est de rendre davantage ludique l'enseignement « Réseaux » de première année de l'IUT Informatique d'Aix-Marseille</p>
            <?php
                 if (isset($_SESSION['connected'])){
                    echo '<a href="../../App/downloadApp.php" class="all-btn">Télécharger</a>';
                 } else {
                    echo '<a href="loginPage.php" class="all-btn">Télécharger</a>';
                }
            ?>
            
        </div>


        <div class="video">
             <video controls>
                <source src="../../Video/guide_utilisationSAE.mp4" type="video/mp4">
            Your browser does not support the video tag.
            </video>
        </div>
    </section>
    
    <!-- home section ends -->


    <!-- footer section starts  -->

   <section class="footer" id="footer">
       <div class="box-container">
           <div class="box">
               <h3>Liens rapides</h3>
               <a href="accueilPage.php"><i class="fas fa-chevron-right"></i>Accueil</a>
               <?php
                if (isset($_SESSION['connected'])){

                // Vérifiez si l'utilisateur est un administrateur
                
                if ($user['user_status'] !== 'Student') {
                    echo '<a href="historyPage.php"><i class="fas fa-chevron-right"></i>Histoires</a>';
                }

            }
            else{
                echo'<a href="loginPage.php"><i class="fas fa-chevron-right"></i>Connexion</a>';
            }
               ?>
               
               <a href="../../App/ConditionsUtilisations.php"> <i class="fas fa-chevron-right"></i> Mentions légales & conditions générales</a>
            </div>
            
            
            <div class="box">
                <h3>Application</h3>
                <?php
                 if (isset($_SESSION['connected'])){
                    echo '<a href="../../App/downloadApp.php"> <i class="fas fa-chevron-right"></i>Télécharger NetWork Stories</a>';
                 } else {
                    echo '<a href="loginPage.php"><i class="fas fa-chevron-right"></i>Télécharger NetWork Stories</a>';
                }
            ?>
           </div>

           <div class="box">
               <h3>Contact</h3>
               <a><i class="fas fa-envelope"></i>nwstories.contact@gmail.com</a>
               <a><i class="fas fa-map-marker-alt"></i>Aix-en-Provence, France</a>
           </div>

       </div>


       <div class="credit">Copyright © 2022 NetWork Stories | tous droits réservés
       </div>
   </section>

    <!-- footer section ends -->


    <script src="../../Js/main.js"></script>

    
</body>

</html>
