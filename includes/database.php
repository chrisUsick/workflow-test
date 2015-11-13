<?php
/* Singleton Database class that wraps a PDO connection.

   It can be used to select rows like this:

   $sql        = "SELECT * FROM games";
   $pdo_result = Database::prepare_and_execute($sql);
   $games      = $pdo_result->fetchAll();

   Or to insert rows like this:

   $sql          = "INSERT INTO games (name, description) VALUES (:name, :description)";
   $new_game_row = ['name' => 'Catan', 'description' => 'The Settlers of Catan is...'];
   $pdo_result   = Database::prepare_and_execute($sql, $new_game_row);
*/

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