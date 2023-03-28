<?php

class UsersNotVerified implements UsersNotVerifiedAccessInterface
{
    public function create(array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO USERSNOTVERIFIED (EMAIL,USER_PASSWORD, TOKEN, EXPIRATION_DATE) VALUES (:email, :user_password, :token, CURRENT_TIMESTAMP + INTERVAL '10 minutes')";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $P_sth->bindValue(':user_password', $A_values['user_password'], PDO::PARAM_STR);
        $P_sth->bindValue(':token', $A_values['token'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();

        $P_db = null;
        $P_sth->closeCursor();
        return $B_state;
    }

    public function getByEmail(string $S_email = null):?UserNotVerified {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT EMAIL, USER_PASSWORD, TOKEN, EXPIRATION_DATE FROM USERSNOTVERIFIED WHERE EMAIL = :email ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_STR);
        $P_sth->execute();
        $A_tuple = $P_sth->fetch(PDO::FETCH_ASSOC);

        $P_db = null;
        $P_sth->closeCursor();
        if($A_tuple != null) {
            return new UserNotVerified($A_tuple['email'], $A_tuple['user_password'], $A_tuple['token'], $A_tuple['expiration_date']);
        }
        return null;
    }

    public function deleteByEmail(string $S_email = null): bool{
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "DELETE FROM USERSNOTVERIFIED WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_STR);
        $B_state = $P_sth->execute();

        $P_db = null;
        $P_sth->closeCursor();
        return $B_state;
    }

    public function update(array $A_values = null): bool {

        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "UPDATE usersnotverified SET TOKEN = :token WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':token', $A_values['token'], PDO::PARAM_STR);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;
        $P_sth->closeCursor();

        return $B_state;
    }
}