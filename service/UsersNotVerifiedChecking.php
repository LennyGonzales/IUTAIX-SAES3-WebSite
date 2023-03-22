<?php

class UsersNotVerifiedChecking
{
    public static function sendMailVerification(Array $A_postParams) :void
    {
        Mailer::sendMail($A_postParams["email"], array("subject"=>"Verification de compte","body"=>"Votre Token de vérification :\n ".strval($A_postParams["token"])));
    }

    /**
     * Verify the credentials and create the not verified account
     * @param array|null $A_values contains the email and the password of the user
     * @param UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess reverse dependencies (ask the interface)
     * @param UsersAccessInterface $usersSqlAccess reverse dependencies (ask the interface)
     * @return string Create specific messages that need to be returned to the user
     */
    public function createAccount(array $A_values = null,UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess, UsersAccessInterface $usersSqlAccess):string {
        $E_state = (new UsersChecking())->verifyMail($usersSqlAccess, $A_values['email']);
        if($E_state != Success::EMAIL_VERIFICATION) { return $E_state; }

        $E_state = (new UsersChecking())->verifyPassword($A_values['user_password'], $A_values['user_password_verification']);
        if($E_state != Success::PASSWORD_VERIFICATION) { return $E_state; }

        // Creation of the user
        $A_values['user_password'] = hash('sha512', $A_values['user_password']);
        if(!$usersNotVerifiedSqlAccess->create($A_values)) { return Errors::GENERIC_ERROR;}

        return Success::SIGNUP;
    }


    public function getByEmail(string $S_email = null, UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess):?array {
        $E_userNotVerified = $usersNotVerifiedSqlAccess->getByEmail($S_email);
        if ($E_userNotVerified != null) {
            return array('email' => $E_userNotVerified->getEmail(), 'user_password' => $E_userNotVerified->getUserPassword(), 'token' => $E_userNotVerified->getToken());
        }
        return null;
    }

    public function deleteByEmail(string $S_email = null, UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess):bool {
        return $usersNotVerifiedSqlAccess->deleteByEmail($S_email);
    }
}