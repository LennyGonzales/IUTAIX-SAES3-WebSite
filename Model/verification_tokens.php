<?php

/**
 * Class verificationtokens
 *
 * This class represents the verificationtokens table in the DB and communicates with it
 */
class verification_tokens extends Model
{

    const DATABASE = "USERS";


    /**
     * Generates a token
     *
     * @return int Generates a random token
     */
    public static function generateToken() : int{
        $I_token = rand(100000, 999999);
        return $I_token;
    }

    /**
     * Send an e-mail
     *
     * @param Array $A_postParams contains the post parameters of the request
     * @return void
     */
    public static function sendMail(Array $A_postParams) : void {
        Mailer::sendMail($A_postParams["email"],array("subject"=>"Récupération de mot de passe","body"=>"Votre Token de récupération :\n ".strval($A_postParams["token"])));

    }

    public static function create(Array $A_postParams) : void {
        $P_connection = Connection::initConnection(self::DATABASE);
        $S_sql = "INSERT INTO verification_tokens (user_email, token,expiration_date) VALUES (:email, :token,CURRENT_TIMESTAMP + INTERVAL '30 minutes')";
        $P_statement = $P_connection->prepare($S_sql);
        $P_statement->bindValue(":email", $A_postParams["email"], PDO::PARAM_STR);
        $P_statement->bindValue(":token", $A_postParams["token"], PDO::PARAM_INT);
        $P_statement->execute();
    }



    public static function checkIfExistsByPrimaryKey(string $S_nameColumn, string $S_value) : bool{
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM ".get_called_class()." WHERE " . $S_nameColumn . " = :value ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':value', $S_value, PDO::PARAM_STR);
        $P_sth->execute(array($S_value));
        return ($P_sth->rowCount() > 0);
    }


    public static function selectByPrimaryKey(string $S_nameColumn, string $S_value) : array{
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "SELECT * FROM verification_tokens WHERE " . $S_nameColumn . " = :value ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':value', $S_value, PDO::PARAM_STR);
        $P_sth->execute(array($S_value));
        return $P_sth->fetch(PDO::FETCH_ASSOC);

    }

    public static function deleteByPrimaryKey(string $S_nameColumn, string $S_value) : bool{
        $P_db = Connection::initConnection(self::DATABASE);
        $S_stmnt = "DELETE FROM verification_tokens WHERE " . $S_nameColumn . " = :value ";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':value', $S_value, PDO::PARAM_STR);
        return $P_sth->execute(array($S_value));


    }







}