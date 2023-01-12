 <?php
    session_start();
    require '../verifySession.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetWork Stories</title>
    <link rel="stylesheet"  type="text/css" href="../../Css/style.css">
    
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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            <?php
                 if (isset($_SESSION['connected'])){
                    echo '<a href="../../App/downloadApp.php" class="all-btn">Télécharger</a>';
                 } else {
                    echo '<a href="loginPage.php" class="all-btn">Télécharger</a>';
                }
            ?>
            
        </div>


        <div class="video">
            <video autoplay muted loop>
                <source src="../../Video/vidTest.mp4" type="video/mp4">
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
               ?>
               <a href="loginPage.php"><i class="fas fa-chevron-right"></i>Connexion</a>
            </div>
            
            
            <div class="box">
                <h3>Application</h3>
                <a href="#"><i class="fas fa-chevron-right"></i>Télécharger NetWork Stories</a>
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
