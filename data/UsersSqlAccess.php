<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class UsersSqlAccess extends Model implements UsersAccessInterface {

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

        if($A_parameters['user_password_verification'] != $S_password) {
            return array(
                'messageType' => $S_messageType,
                'message' => 'Le mot de passe et sa vérification doivent être équivalent !'
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

    public static function selectByEmail(array $A_parameters = null):array {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT EMAIL, USER_PASSWORD, USER_STATUS, POINTS FROM USERS WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_parameters['email'], PDO::PARAM_INT);
        $P_sth->execute();
        $S_status = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;
        return $S_status;
    }


    public static function getUser(string $email, string $password):?User {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT EMAIL, USER_PASSWORD, USER_STATUS, POINTS FROM USERS WHERE EMAIL = :email AND USER_PASSWORD= :password";
        $P_sth = $P_db->prepare($S_stmnt);

        $P_sth->bindValue(':email', $email, PDO::PARAM_STR);
        $P_sth->bindValue(':password', $password, PDO::PARAM_STR);

        $P_sth->execute();
        $A_result = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;

        if($A_result != null) {
            return new User($A_result['email'], $A_result['user_password'], $A_result['user_status'], $A_result['points']);
        }
        return null;
    }
}