<?php
/**
 * Abstract class representing a model for a database table
 */
abstract class Model
{
    /**
     * Delete a tuple of a table by its id
     * @param string $database the database name concerned
     * @param string|null $S_id the id of the tuple
     * @return bool if the deletion worked
     */
    public static function deleteById(string $database, string $S_id = null): bool
    {
        $P_db = Connection::initConnection($database);
        $S_stmnt = "DELETE FROM " . get_called_class() . " WHERE ID = :id;";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $P_db = null;

        return $B_state;
    }

    /**
     * Get a tuple of a table by its id
     * @param string $database the database name concerned
     * @param string|null $S_id the id of the tuple
     * @return array|null array containing all the parameters/attributes of the table
     */
    public static function getById(string $database, string $S_id = null):?array
    {
        $P_db = Connection::initConnection($database);
        $S_stmnt = "SELECT * FROM " . get_called_class() . " WHERE ID = :id";
        $P_sth = $P_db->prepare($S_stmnt);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        $B_state = $P_sth->fetch();

        if($B_state) {
            return $B_state;
        }
        return null;
    }
}