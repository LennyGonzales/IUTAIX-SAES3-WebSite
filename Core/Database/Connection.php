<?php

/**
 * Class Connection
 *
 * This class is responsible for creating the connection with the database.
 */
final class Connection
{

    public function getDbCredentials(string $S_databaseName = null):array {
        return array(
            'host' => getenv('DB_HOST'),
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'dbname' => getenv('DB_' . $S_databaseName . '_DBNAME')
        );
    }

    /**
     * Establish connection with the database
     *
     * @param string $host The hostname of the database
     * @param string $user The username of the database
     * @param string $password The password of the database
     *
     * @return PDO|null The PDO connection
     */
    public static function connect(array $A_credentials = null) : PDO
    {
        try
        {
            $bdd = new PDO(
                "pgsql:host=" . $A_credentials['host'] . ";
                port=5432;
                dbname=" . $A_credentials['dbname'] . ";
                user=" . $A_credentials['user'] . ";
                password=" . $A_credentials['password']
            );
            return $bdd;
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    /**
     * Initialize the connection with the database
     *
     * @return PDO|null The PDO connection
     */
    public static function initConnection(string $S_dbName = "STORIES") : PDO
    {
        $P_connection = new Connection();
        $A_credentials = $P_connection->getDbCredentials($S_dbName);    // Get the credentials
        return $P_connection->connect($A_credentials);
    }

}
