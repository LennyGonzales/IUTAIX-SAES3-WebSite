<?php

class UsersChecking
{
    public function verifyAuthentication(Array $A_parameters = null, UsersAccessInterface $usersSqlAccess) {
        $E_User = $usersSqlAccess::getUser($A_parameters['email'],hash('sha512', $A_parameters['user_password']));

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
}