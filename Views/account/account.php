<?php

echo "
    <div class='container' id='container'>
    
        <div class='form-container sign-up-container'>
            <form action='' method='POST'>
                <h1>Créer un compte</h1>
                <input type='text' class='box-input' name='email' placeholder='Email' required />  
                <input type='password' class='box-input' name='user_password' placeholder='Mots de passe' required />            
                <label for='terms' class='terms-label'>
                <input type='checkbox'  name='terms' id='terms' required>
                <a href='' class='terms-link' style='font-size: 0.6em'> Accepter les conditions générales d'utilisation</a>
                </label>
                <br>
                <input type='submit' name='inscription' value='Inscrire' onclick='' />          
            </form>
        </div>
        
        <div class='form-container sign-in-container'>
            <form action='/account/connect' method='POST'>
                <h1>Connexion</h1>
                <input type='text' class='box-input' name='email' placeholder='Email'/>
                <input type='password' class='box-input' name='user_password' placeholder='Mot de passe'/>
                <a href='#'>Mot de passe oublié?</a>
                <input type='submit' value='Connexion ' name='connexion'/>";

                if(isset($A_view['errorMessage'])) {
                    echo "<p class='errorMessage'>L'email et/ou le mot de passe est incorrect</p>";
                }
echo "
            </form>
        </div>
        <div class='overlay-container'>
            <div class='overlay'>
                <div class='overlay-panel overlay-left'>
                    <h1>Re bonjour !</h1>
                    <p>Connecte-toi pour commencer.</p>
                    <button class='ghost'id='signIn'>Connexion</button>
                </div>
                <div class='overlay-panel overlay-right'>
                    <h1>Bienvenue !</h1>
                    <p>Crée un compte pour rester connecté.</p>
                    <button class='ghost' id='signUp'>Créer un compte</button>
                </div>
            </div>
        </div>
    </div>
<script src='/static/js/login.js'></script>

";