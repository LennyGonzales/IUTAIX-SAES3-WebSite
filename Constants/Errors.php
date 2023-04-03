<?php

class Errors
{
    const GENERIC_ERROR = 'Une erreur s\'est produite. Veuillez réessayer.';
    const INVALID_REQUEST = 'La requête est invalide.';

    // Login
            const LOGIN = 'Votre email et/ou votre mot de passe est incorrect !';

    // Sign up
            const SIGNUP_ALREADY_EXISTS = 'L\'utilisateur est déjà existant, veuillez-vous connecter';

    // Password
            const PASSWORD_NOT_EQUALS_VERIFICATION_PASSWORD = 'Le mot de passe et sa vérification doivent être équivalent !';
            const PASSWORD_LENGTH_INSUFFICIENT = 'Le mot de passe doit comporter 12 caractères.';
            const PASSWORD_NO_UPPERCASE = 'Le mot de passe doit contenir au moins une majuscule.';
            const PASSWORD_NO_SPECIAL_CHARS = 'Le mot de passe doit contenir un caractère spécial.';
            const PASSWORD_NO_NUMBER = 'Le mot de passe doit contenir au moins un chiffre.';

    // Email
            const EMAIL_NOT_AMU = 'L\'email inséré n\'est pas un email AMU.';
            const EMAIL_NOT_EXISTS = 'Le mail spécifié n\'existe pas';
            const EMAIL_OR_TOKENS_NOT_EXISTS = 'Erreur lié à l\'email ou au token.';

    // Question
            const QUESTION_ALREADY_EXISTS = 'La question existe déjà !';
            const QUESTION_NOT_EXISTS = 'La question n\'existe pas !';
}