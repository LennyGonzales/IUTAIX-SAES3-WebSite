<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class Users extends Model {

    const DATABASE = 'USERS';

    public static function checkIfExistsByEmail(string $S_email = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM USERS WHERE EMAIL = :email ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_STR);
        $P_sth->execute();
        return ($P_sth->rowCount() > 0);
    }

    public static function create(array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO USERS (EMAIL,USER_PASSWORD) VALUES (:email, :user_password)";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $P_sth->bindValue(':user_password', $A_values['user_password'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        return $B_state;
    }

    public static function createAccount(Array $A_parameters):array {
        $S_email = $A_parameters['email'];
        $S_password = $A_parameters['user_password'];

        $S_messageType = 'error';
        if(self::checkIfExistsByEmail($S_email)) { // Verify if the user already exists
            return array(
                'messageType' => $S_messageType,
                'message' => "L'utilisateur est déjà existant, veuillez-vous connecter"
            );
        }

        // Verification of the email and the password
        if (substr($S_email, -16, 16) == "@etu.univ-amu.fr" || $S_email == "safa.yahi@univ-amu.fr") {
            // Vérifie si le mot de passe contient 12 caractères, au moins une majuscule,un caractère spécial et un chiffre
            if (strlen($S_password) < 12) {
                return array(
                    'messageType' => $S_messageType,
                    'message' => 'Le mot de passe doit comporter 12 caractères.'
                );
            } elseif (!preg_match('/[A-Z]/', $S_password)) {
                return array(
                    'messageType' => $S_messageType,
                    'message' => 'Le mot de passe doit contenir au moins une majuscule.'
                );
            } elseif (!preg_match('/[\'^£$%&*()}{@#~?!><>,;.|=_+¬-]/', $S_password)) {
                return array(
                    'messageType' => $S_messageType,
                    'message' => 'Le mot de passe doit contenir un caractère spécial.'
                );
            } elseif (!preg_match('/\d/', $S_password)) {
                return array(
                    'messageType' => $S_messageType,
                    'message' => 'Le mot de passe doit contenir au moins un chiffre.'
                );
            }

            $A_parameters['user_password'] = hash('sha512', $A_parameters['user_password']);
            if(!self::create($A_parameters)) {
                return array(
                    'messageType' => $S_messageType,
                    'message' => 'Erreur du serveur, veuillez réessayer.'
                );
            }

            return array(
                'messageType' => 'successful',
                'message' => "Votre compte a été créé"
            );
        }

        return array(
            'messageType' => $S_messageType,
            'message' => "L'email inséré n'est pas un email AMU."
        );
    }

    public static function verifyAuthentication(Array $A_parameters):array {
        $A_row = self::selectByPrimaryKey('EMAIL',$A_parameters['email']);
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
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT USER_STATUS FROM USERS WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_parameters['email'], PDO::PARAM_INT);
        $P_sth->execute();
        $S_status = $P_sth->fetch(PDO::FETCH_ASSOC)['user_status'];
        $P_db = null;
        return $S_status;
    }
}