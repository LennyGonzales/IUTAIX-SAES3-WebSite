<?php

class UsersChecking
{
    /**
     * Verify the user authentication
     * @param array|null $A_parameters contains the email and the password of the user
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask an interface)
     * @return array|string[] Create specific messages that need to be returned to the user
     */
    public function verifyAuthentication(Array $A_parameters = null, UsersAccessInterface $usersSqlAccess):array {
        $E_User = $usersSqlAccess->getByEmailAndPassword($A_parameters['email'],hash('sha512', $A_parameters['user_password']));

        if($E_User != null) {  // If the user exists and the password in the DB is equal to the password entered
            return array(
                'user_status' => $E_User->getUserStatus(),
                'messageType' => 'successful',
                'message' => 'Vous êtes connecté'
            );
        }
        return array(
            'messageType' => 'error',
            'message' => 'Votre email et/ou votre mot de passe est incorrect !'
        );
    }


    /**
     * Verify the credentials and create the account
     * @param array|null $A_parameters contains the email and the password of the user
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask an interface)
     * @return array|string[] Create specific messages that need to be returned to the user
     */
    public function createAccount(Array $A_parameters = null, UsersAccessInterface $usersSqlAccess):array {
        $S_email = $A_parameters['email'];
        $S_password = $A_parameters['user_password'];

        $S_messageType = 'error';
        if($usersSqlAccess->getByEmail($S_email) != null) { // Verify if the user already exists
            return array('messageType' => $S_messageType, 'message' => "L'utilisateur est déjà existant, veuillez-vous connecter");
        }

        // Verify if the password and the password verification are equals
        if($A_parameters['user_password_verification'] != $S_password) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe et sa vérification doivent être équivalent !');
        }

        // Verification of the email and the password
        if ((substr($S_email, -16, 16) != "@etu.univ-amu.fr")
            && (substr($S_email, -12, 12) != "@univ-amu.fr")) {
            return array('messageType' => $S_messageType, 'message' => "L'email inséré n'est pas un email AMU.");
        }


        // Verification of the password
        if (strlen($S_password) < 12) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe doit comporter 12 caractères.');
        }
        if (!preg_match('/[A-Z]/', $S_password)) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe doit contenir au moins une majuscule.');
        }
        if (!preg_match('/[\'^£$%&*()}{@#~?!><>,;.|=_+¬-]/', $S_password)) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe doit contenir un caractère spécial.');
        }
        if(!preg_match('/\d/', $S_password)) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe doit contenir au moins un chiffre.');
        }

        // Creation of the user
        $A_parameters['user_password'] = hash('sha512', $A_parameters['user_password']);
        if(!$usersSqlAccess->create($A_parameters)) {
            return array('messageType' => $S_messageType, 'message' => 'Erreur du serveur, veuillez réessayer.');
        }

        $E_User = $usersSqlAccess->getByEmail($S_email);
        return array('user_status' => $E_User->getUserStatus() ,'messageType' => 'successful', 'message' => "Votre compte a été créé");
    }
}