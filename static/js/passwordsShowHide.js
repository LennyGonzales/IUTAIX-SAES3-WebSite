var list= {
    'toggleSigninPassword' : 'signin_password_text',
    'toggleSignupPassword' : 'signup_password_text',
    'toggleSignupVerificationPassword' : 'signup_verification_password_text'
};

// for all toggles, we add an event listener
for (var key in list) {
    let toggle = document.querySelector(`#${key}`);
    let password = document.querySelector(`#${list[key]}`);

    toggle.addEventListener('click', function (e) {
        // toggle the type attribute
        const type =  password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
}