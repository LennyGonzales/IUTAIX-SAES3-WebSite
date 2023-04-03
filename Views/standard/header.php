<?php

echo "<header class='header'>
    <div class='logo'>
        <a href='/home'><img src='/static/content/images/logo-nws.png' alt='logo-nws'></a>
    </div>

    <nav class='navbar'>
        <a href='/home' class='underline'>Accueil</a>";

if (Session::check()) {
    if(Session::getSession()['user_status'] !== 'Student') {
        echo "<a href='/stories' class='underline'>Histoires</a>";
    }
    if ($_SESSION['user_status'] !== 'Student') {
        echo "<a href='/home/guideDocker' class='underline'>Guide docker</a>";

    }
    echo "<a href='/profile' class='underline'>Profil</a>";
    echo "<a href='/logout' class='btn'>Deconnexion</a>";
}
else {
    echo "<a href='/account' class='btn'>Connexion</a>";
}

echo "</nav>
    <div class='fas fa-bars' id='menu-btn'></div>
</header>
<script src='/static/js/main.js'></script>
";