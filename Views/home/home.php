<?php

echo "
    <section class='home' id='home'>
        <div class='content'>
            <h1>NetWork Stories</h1>
            <p>L'objectif de NetWork Stories est de rendre davantage ludique l'enseignement « Réseaux » de première année de l'IUT Informatique d'Aix-Marseille</p>";

if (Session::check()) {
    echo "<a href='https://drive.google.com/uc?export=download&id=105XA6CzcPVj3DmqBxV6N0r9ndUG8rGfy' class='all-btn'>Télécharger sur Windows</a>";
    echo "<a href='https://drive.google.com/uc?export=download&id=1_ThRVOjSqr0O4T04m-lHzpEWqpek99qg' class='all-btn'>Télécharger sur MacOS</a>";

} else {
    echo "<a href='/account' class='all-btn'>Télécharger sur Windows</a>";
    echo "<a href='/account' class='all-btn'>Télécharger sur MacOS</a>";

}



echo " </div>
        <div class='video'>
             <video controls>
                <source src='/static/content/videos/guide_utilisationSAE.mp4' type='video/mp4'>
            Your browser does not support the video tag.
            </video>
        </div>
    </section>";

