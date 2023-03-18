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
     * @return array|string[] Create specific messages that need to be returned to the user
     */
    public function createAccount(array $A_values = null,UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess, UsersAccessInterface $usersSqlAccess):array {
        $S_email = $A_values['email'];
        $S_password = $A_values['user_password'];
        $S_verification_password = $A_values['user_password_verification'];

        $S_messageType = 'error';
        if($usersSqlAccess->getByEmail($S_email) != null) { // Verify if the user already exists
            return array('messageType' => $S_messageType, 'message' => "L'utilisateur est déjà existant, veuillez-vous connecter");
        }

        // Verification of the email and the password
        if ((substr($S_email, -16, 16) != "@etu.univ-amu.fr")
            && (substr($S_email, -12, 12) != "@univ-amu.fr")) {
            return array('messageType' => $S_messageType, 'message' => "L'email inséré n'est pas un email AMU.");
        }

        // Verify if the password and the password verification are equals
        if($S_verification_password != $S_password) {
            return array('messageType' => $S_messageType, 'message' => 'Le mot de passe et sa vérification doivent être équivalent !');
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
        $A_values['user_password'] = hash('sha512', $S_password);
        if(!$usersNotVerifiedSqlAccess->create($A_values)) {
            return array('messageType' => $S_messageType, 'message' => 'Erreur du serveur, veuillez réessayer.');
        }

        return array('messageType' => 'successful', 'message' => "Votre compte a été créé, nous vous avons envoyé un mail de verification !");
    }


    public function getByEmail(string $S_email = null, UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess):array {
        $E_userNotVerified = $usersNotVerifiedSqlAccess->getByEmail($S_email);

        return array('email' => $E_userNotVerified->getEmail(), 'user_password' => $E_userNotVerified->getUserPassword(), 'token' => $E_userNotVerified->getToken());
    }

    public function deleteByEmail(string $S_email = null, UsersNotVerifiedAccessInterface $usersNotVerifiedSqlAccess):bool {
        return $usersNotVerifiedSqlAccess->deleteByEmail($S_email);
    }
}