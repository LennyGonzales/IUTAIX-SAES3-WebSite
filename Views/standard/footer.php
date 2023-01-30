<?php
echo "
<section class='footer' id='footer'>
    <div class='box-container'>
        <div class='box'>
            <h3>Liens rapides</h3>
            <a href='/home'><i class='fas fa-chevron-right'></i>Accueil</a>
            ";
            if ((Session::check()) && (Session::getSession()['user_status'] !== 'Student')) {
                    echo "<a href=''><i class='fas fa-chevron-right'></i>Histoires</a>";
            }
            else{
                echo"<a href='/account'><i class='fas fa-chevron-right'></i>Connexion</a>";
            };
echo " 

            <a href=''> <i class='fas fa-chevron-right'></i> Mentions légales & conditions générales</a>
        </div>


        <div class='box'>
            <h3>Application</h3>";

            if (Session::check()) {
                echo "<a href=''> <i class='fas fa-chevron-right'></i>Télécharger NetWork Stories</a>";
            } else {
                echo "<a href='/account''><i class='fas fa-chevron-right'></i>Télécharger NetWork Stories</a>";
            }

echo "
        </div>

        <div class='box'>
            <h3>Contact</h3>
            <a><i class='fas fa-envelope'></i>nwstories.contact@gmail.com</a>
            <a><i class='fas fa-map-marker-alt'></i>Aix-en-Provence, France</a>
        </div>

    </div>


    <div class='credit'>Copyright © 2022 NetWork Stories | tous droits réservés
    </div>
</section>";