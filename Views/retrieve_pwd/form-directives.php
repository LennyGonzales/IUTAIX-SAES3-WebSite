<?php
echo("<section class='retrieve-password-form-section'>
        <h1>Requête de récupération de mot de passe</h1>
        <form class='default-form' method='post' action='/retrievepwddirectives/send'>
                <input type='text' placeholder='Votre mail' name='email' required><br>                
                <input type='submit' id='submit' value='Valider' >
        </form>
    </section>
    ");