<?php

class RetrievePasswords implements RetrievePasswordAccessInterface
{
    public function create(array $A_values = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "INSERT INTO RETRIEVE_PASSWORDS (EMAIL, TOKEN, EXPIRATION_DATE) VALUES (:email, :token, CURRENT_TIMESTAMP + INTERVAL '10 minutes')";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $P_sth->bindValue(':token', $A_values['token'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;
        return $B_state;
    }

    public function getByEmail(string $S_email = null): ?RetrievePassword
    {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT EMAIL, TOKEN, EXPIRATION_DATE FROM RETRIEVE_PASSWORDS WHERE EMAIL = :email ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_STR);
        $P_sth->execute();
        $A_tuple = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;

        if($A_tuple != null) {
            return new RetrievePassword($A_tuple['email'], $A_tuple['token'], $A_tuple['expiration_date']);
        }
        return null;
    }

    public function update(array $A_values = null): bool
    {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "UPDATE RETRIEVE_PASSWORDS SET TOKEN = :token WHERE EMAIL = :email";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':token', $A_values['token'], PDO::PARAM_STR);
        $P_sth->bindValue(':email', $A_values['email'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;

        return $B_state;
    }

    public function delete(string $S_email = null):bool {
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "DELETE FROM RETRIEVE_PASSWORDS WHERE EMAIL = :email;";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':email', $S_email, PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;

        return $B_state;
    }
}