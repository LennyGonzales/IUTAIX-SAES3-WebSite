<?php

/**
 * Class Users
 *
 * This class represents the Users table in the DB and communicates with it
 */
class Users extends Model {

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

    /**
     * Selects a user by their user id
     *
     * @param string $S_user_id the user id
     * @return array the user
     */
    public static function selectByUserEmail(string $S_email) : array{
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT * FROM USERS WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_INT);
        $P_sth->execute();
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;
        return $A_row;
    }
}