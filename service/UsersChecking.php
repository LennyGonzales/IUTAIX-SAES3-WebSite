<?php

class UsersChecking
{
    /**
     * Verify the user authentication
     * @param array|null $A_parameters contains the email and the password of the user
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask an interface)
     * @return array Create specific messages that need to be returned to the user
     */
    public function verifyAuthentication(Array $A_parameters = null, UsersAccessInterface $usersSqlAccess):array {
        sleep(0.1);     // Reduce the effectiveness of brute forcing because the opponent have to wait 0.1s for each request

        $E_User = $usersSqlAccess->getByEmailAndPassword($A_parameters['email'],hash('sha512', $A_parameters['user_password']));

        if($E_User != null) {  // If the user exists and the password hashed in the database is equal to the password hashed entered by the user
            return array('user_status' => $E_User->getUserStatus(), 'message' => Success::LOGIN);
        }
        return array('message' => Errors::LOGIN);
    }

    /**
     * Create the account
     * @param array|null $A_values contains the email and the password of the user
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask the interface)
     * @return string Create specific messages that need to be returned to the user
     */
    public function createAccount(array $A_values = null, UsersAccessInterface $usersSqlAccess):string {
        if($usersSqlAccess->create($A_values)) {
            return Success::SIGNUP_AFTER_VERIFIED;
        }
        return Errors::GENERIC_ERROR;
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

    /**
     * Verify a password
     * @param string $S_password the passqword
     * @param string $S_verification_password the verification password
     * @return string Create specific messages that need to be returned to the user
     */
    public function verifyPassword(string $S_password, string $S_verification_password):string {
        // Verify if the password and the password verification are equals
        if($S_verification_password != $S_password) { return Errors::PASSWORD_NOT_EQUALS_VERIFICATION_PASSWORD; }

        // Verification of the password
        if (strlen($S_password) < 12) { return Errors::PASSWORD_LENGTH_INSUFFICIENT; }

        if (!preg_match('/[A-Z]/', $S_password)) { return Errors::PASSWORD_NO_UPPERCASE;}

        if (!preg_match('/[\'^£$%&*()}{@#~?!><>,;.|=_+¬-]/', $S_password)) { return Errors::PASSWORD_NO_SPECIAL_CHARS;}

        if(!preg_match('/\d/', $S_password)) { return Errors::PASSWORD_NO_NUMBER; }

        return Success::PASSWORD_VERIFICATION;
    }

    /**
     * Verify a mail
     * @param string $S_mail the mail
     * @return string Create specific messages that need to be returned to the user
     */
    public function verifyMail(UsersAccessInterface $usersSqlAccess , string $S_email):string {
        // Verify if the user already exists
        if($usersSqlAccess->getByEmail($S_email) != null) { return Errors::SIGNUP_ALREADY_EXISTS;}

        // Verification of the email and the password
        if ((substr($S_email, -16, 16) != "@etu.univ-amu.fr") && (substr($S_email, -12, 12) != "@univ-amu.fr")) { return Errors::EMAIL_NOT_AMU; }

        return Success::EMAIL_VERIFICATION;
    }

    /**
     * Return the leaderboard
     * @param UsersAccessInterface $usersSqlAccess
     * @return array|null the leaderboard
     */
    public function getLeaderboard(UsersAccessInterface $usersSqlAccess):?array {
        return $usersSqlAccess->getLeaderboard();
    }

    public function update(UsersAccessInterface $usersSqlAccess, array $A_values):bool {
        return $usersSqlAccess->update($A_values);
    }
}