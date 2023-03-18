<?php

class RetrievePasswordChecking
{
    public function create(Array $A_values = null, RetrievePasswordAccessInterface $retrievePasswordSqlAccess):bool {
        return $retrievePasswordSqlAccess->create($A_values);
        // to do : create and return message
    }

    public function sendMail(Array $A_postParams) :void{
        Mailer::sendMail($A_postParams["email"], array("subject"=>"Récupération de mot de passe","body"=>"Votre Token de récupération :\n ".strval($A_postParams["token"])));
    }

    public function getByEmail(string $S_email = null, RetrievePasswordAccessInterface  $retrievePasswordSqlAccess):?array {
        $E_RetrievePassword = $retrievePasswordSqlAccess->getByEmail($S_email);

        if($E_RetrievePassword != null) {   // If the tuple exists
            return array('email' => $E_RetrievePassword->getEmail(), 'token' => $E_RetrievePassword->getToken(), 'expiration_date' => $E_RetrievePassword->getExpirationDate());
        }
        return null;
    }

    public function update(Array $A_values = null, RetrievePasswordAccessInterface $retrievePasswordSqlAccess):bool {
        return $retrievePasswordSqlAccess->update($A_values);
    }

    public function verifyPassword(Array $A_values = null):array {
        $S_password = $A_values['user_password'];
        $S_verification_password = $A_values['user_password_verification'];

        $S_messageType = 'error';
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

        return array('messageType' => 'successful', 'message' => 'Le mot de passe est validé');
    }


    public function deleteByEmail(string $S_email = null, RetrievePasswordAccessInterface $retrievePasswordSqlAccess):bool {
        return $retrievePasswordSqlAccess->delete($S_email);
    }
}