<?php
// Vérification de l'existence de la variable de session "connected"
if (isset($_SESSION['connected'])){
    // Affectation de la variable de session "user" à la variable locale $user
    $user = $_SESSION['user'];
}