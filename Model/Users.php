<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class Users extends Model {

    public static function createAccount(Array $A_parameters):array {
        $email = $A_parameters['email'];
        $password = $A_parameters['user_password'];

        $messageType = 'error';
        $message = null;
        if(self::checkIfExistsByPrimaryKey('EMAIL', $email)) { // Verify if the user already exists
            return array(
                'messageType' => $messageType,
                'message' => "L'utilisateur est déjà existant, veuillez-vous connecter"
            );
        }

        // Verification of the email and the password
        if (substr($email, -16, 16) == "@etu.univ-amu.fr" || $email == "safa.yahi@univ-amu.fr") {
            // Vérifie si le mot de passe contient 12 caractères, au moins une majuscule,un caractère spécial et un chiffre
            if (strlen($password) < 12) {
                return array(
                    'messageType' => $messageType,
                    'message' => 'Le mot de passe doit comporter 12 caractères.'
                );
            } elseif (!preg_match('/[A-Z]/', $password)) {
                return array(
                    'messageType' => $messageType,
                    'message' => 'Le mot de passe doit contenir au moins une majuscule.'
                );
            } elseif (!preg_match('/[\'^£$%&*()}{@#~?!><>,;.|=_+¬-]/', $password)) {
                return array(
                    'messageType' => $messageType,
                    'message' => 'Le mot de passe doit contenir un caractère spécial.'
                );
            } elseif (!preg_match('/\d/', $password)) {
                return array(
                    'messageType' => $messageType,
                    'message' => 'Le mot de passe doit contenir au moins un chiffre.'
                );
            }

            $A_parameters['user_password'] = hash('sha512', $A_parameters['user_password']);
            if(!self::create($A_parameters)) {
                return array(
                    'messageType' => $messageType,
                    'message' => 'Erreur du serveur, veuillez réessayer.'
                );
            }

            return array(
                'messageType' => 'successful',
                'message' => "Votre compte a été créé"
            );
        }

        return array(
            'messageType' => $messageType,
            'message' => "L'email inséré n'est pas un email AMU."
        );
    }

    public static function verifyAuthentication(Array $A_parameters):array {
        $A_row = self::selectByPrimaryKey('EMAIL',$A_parameters['email']);
        var_dump($A_row);
        echo hash('sha512', $A_parameters['user_password']);
        if(($A_row != null) && ($A_row['user_password'] == hash('sha512', $A_parameters['user_password']))) {  // If the user exists and the password in the DB is equal to the password entered
            return array(
                'user_status' => $A_row['user_status'],
                'messageType' => 'successful',
                'message' => 'Vous êtes connecté'
            );
        }
        return array(
            'messageType' => 'error',
            'message' => 'Votre email et/ou votre mot de passe est incorrect !'
        );
    }

    public static function selectStatus(Array $A_parameters):?string {
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT USER_STATUS FROM USERS WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_parameters['email'], PDO::PARAM_INT);
        $P_sth->execute();
        $S_status = $P_sth->fetch(PDO::FETCH_ASSOC)['user_status'];
        $P_db = null;
        return $S_status;
    }
}