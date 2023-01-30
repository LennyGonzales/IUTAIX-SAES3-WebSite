<?php

echo "<header class='header'>
    <div class='logo'>
        <img src='/static/content/images/logo-nws.png' alt='logo-nws'>
    </div>

    <nav class='navbar'>
        <a href='/home' class='underline'>Accueil</a>";

if (Session::check()) {
    if(Session::getSession()['user_status'] !== 'Student') {
        echo "<a href='' class='underline'>Histoires</a>";
    }
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