<?php
/**
 * Abstract class representing a model for a database table
 */
abstract class Model{
    /**
     * Selects all entries from the database
     * @return array All entries from the database
     */
    public static function selectAll(): array{
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class();
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->execute();
        $P_db = null;
        return $P_sth->fetchAll();
    }

    public static function deleteById(string $S_id = null):bool {
        $P_db = Connection::initConnection();
        $S_stmnt = "DELETE FROM ".get_called_class(). " WHERE ID = :id;";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;

        return $B_state;
    }

}