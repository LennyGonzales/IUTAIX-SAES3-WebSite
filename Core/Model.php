<?php
/**
 * Abstract class representing a model for a database table
 */
abstract class Model{
    /**
     * Selects the number of entries from the database
     * @return int The number of entries
     */
    public static function selectCount() : int{
        $P_db = Connection::initConnection();
        $S_stmnt = "SELECT count(*) FROM ".get_called_class();
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->execute();
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $P_db = null;
        return $A_row['count'];
    }

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

}