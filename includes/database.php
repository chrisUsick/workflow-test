<?php
// Singleton Database class that wraps a PDO connection.

class Database {
    const HOST = 'localhost';
    const DBNAME = 'boardgamegeek';
    const DBUSER = 'serveruser';
    const DBPASSWORD = 'gorgonzola7!';

    private $connection;
    
    // The constructor is private. 
    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::DBUSER, self::DBPASSWORD);
        } catch(PDOException $e) {
            die("DB Error: " . $e->getMessage()); // A nicer recovery would be good here. Even a redirect to an HTTP 500 error page would do.
        }
    }

    // Also private, the only way to interact with the singleton is the prepare_and_execute function.
    private static function get_instance() {
        static $instance = null; // Static, so only gets set to NULL the first time this method is run.

        if (null === $instance) {
            $instance = new static(); // Calls the private constructor.
        }

        return $instance;
    }

    // All database interaction happens using this static method.
    public static function prepare_and_execute($sql, $data = []) {
        $connection = self::get_instance()->connection;

        $prepared = $connection->prepare($sql);
        $prepared->execute($data);

        return $prepared;
    }
}

?>