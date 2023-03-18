<?php
echo("<form class='sigin' method='post' action='/Account/verification'>
        <label><b>Adresse mail</b></label>
        <input type='text' placeholder='Entrez votre adresse mail' name='email' required><br>
        <label><b>Verification de compte</b></label>
        <input type='text' placeholder='Votre token de verification' name='token' required><br>
        <input type='submit' id='submit' value='Valider' >
        
    </form>");


