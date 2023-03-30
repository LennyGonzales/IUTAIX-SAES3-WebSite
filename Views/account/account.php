<?php

echo "

    <div class='container' id='container'>
    
        <div class='form-container sign-up-container'>
        <form id='formulaire' action='/account/signUpRequest' method='POST' onSubmit='return false;'>
                <h1>Créer un compte</h1>
                <input type='text' class='box-input' name='email' placeholder='Email' required />  
                <div class='password'>
                    <input type='password' id='signup_password_text' class='box-input' name='user_password' placeholder='Mots de passe' required />
                    <i class='far fa-eye togglePassword' id='toggleSignupPassword'></i>   
                </div>    
                <div class='password'>    
                    <input type='password' id='signup_verification_password_text' class='box-input' name='user_password_verification' placeholder='Vérification du mot de passe' required />  
                    <i class='far fa-eye togglePassword' id='toggleSignupVerificationPassword'></i>
                </div> 
                              
                <input type='checkbox' id='terms' required>
                <a href='' class='terms-link' style='font-size: 0.6em'> Accepter les conditions générales d'utilisation</a>
                </label>
                <br>
                <input type='submit' value='Inscrire'/>         
          <input type='hidden' name='g-recaptcha-response' id='g-recaptcha-response'>   
            </form>
            
        </div> 
        
        <div class='form-container sign-in-container'>
            <form action='/account/connect' method='POST'>
                <h1>Connexion</h1>
                <input type='text' class='box-input' name='email' placeholder='Email'/>
                <div class='password'>
                    <input type='password' id='signin_password_text' class='box-input' name='user_password' placeholder='Mot de passe'/>
                    <i class='far fa-eye togglePassword' id='toggleSigninPassword'></i>
                </div>
                <a href='/retrievepwddirectives'>Mot de passe oublié?</a>
                <input type='submit' value='Connexion ' name='connexion'/>
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
<script src='/static/js/passwordsShowHide.js'></script>
<script src='https://www.google.com/recaptcha/api.js?render=6LdAiTUlAAAAAJsWaH8xf6uziWkixXGQTFsVg9_K'></script>
<script>
grecaptcha.ready(function() {
    document.getElementById('formulaire').addEventListener('submit', function(e) {
        e.preventDefault();
        grecaptcha.execute('6LdAiTUlAAAAAJsWaH8xf6uziWkixXGQTFsVg9_K', {action: 'submit'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
            document.getElementById('formulaire').submit();
        });
    });
});
</script>
";



?>