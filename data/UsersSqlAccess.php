<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class UsersSqlAccess extends Model implements UsersAccessInterface {
    public static function create(array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO USERS (EMAIL,USER_PASSWORD) VALUES (:email, :user_password)";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $P_sth->bindValue(':user_password', $A_values['user_password'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        return $B_state;
    }

    public static function getByEmail(string $S_email = null):?User {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT EMAIL, USER_PASSWORD, USER_STATUS, POINTS FROM USERS WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_INT);
        $P_sth->execute();
        $A_result = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;

        if($A_result != null) {
            return new User($A_result['email'], $A_result['user_password'], $A_result['user_status'], $A_result['points']);
        }
        return null;
    }


    public static function getByEmailAndPassword(string $email, string $password):?User {
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