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

        if($E_User != null) {  // If the user exists and the password hashed in the database is equal to the password hashed entered by the user
            return array('user_status' => $E_User->getUserStatus(), 'messageType' => 'successful', 'message' => 'Vous êtes connecté');
        }

        return array('messageType' => 'error', 'message' => 'Votre email et/ou votre mot de passe est incorrect !');
    }

    /**
     * Create the account
     * @param array|null $A_values contains the email and the password of the user
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask the interface)
     * @return array|string[] Create specific messages that need to be returned to the user
     */
    public function createAccount(array $A_values = null, UsersAccessInterface $usersSqlAccess):array {
        if($usersSqlAccess->create($A_values)) {
            return array('messageType' => 'successful', 'message' => 'Votre compte a été crée');
        }
        return array('messageType' => 'error', 'message' => 'Erreur du serveur, veuillez réessayer');
    }

    /**
     * Get the user by its email
     * @param string|null $S_email the user's email
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask the interface)
     * @return array|null the user if it exists or null
     */
    public function getByEmail(string $S_email = null, UsersAccessInterface $usersSqlAccess):?array {
        $E_User = $usersSqlAccess->getByEmail($S_email);

        if($E_User != null) {  // If the user exists and the password hashed in the database is equal to the password hashed entered by the user
            return array('email' => $E_User->getEmail(), 'user_password' => $E_User->getPassword(), 'user_status' => $E_User->getUserStatus(), 'points' => $E_User->getPoints());
        }
        return null;
    }

    /**
     * Update the account
     * @param array|null $A_values contains the values of the necessary attributes
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask the interface)
     * @return bool if the update worked
     */
    public function updateAccount(Array $A_values = null, UsersAccessInterface $usersSqlAccess):bool {
        return $usersSqlAccess->update($A_values);
    }
}