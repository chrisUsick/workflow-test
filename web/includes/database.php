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
    const DBVENDOR   = 'mysql';
    const DBHOST     = 'localhost';
    const DBNAME     = 'boardgamegeek';
    const DBUSER     = 'serveruser';
    const DBPASSWORD = 'gorgonzola7!';
    const DBPORT     = 3306;

    private $connection;

    // The constructor is private.
    private function __construct() {
        $dbvendor   = self::DBVENDOR;
        $dbhost     = self::DBHOST;
        $dbname     = self::DBNAME;
        $dbuser     = self::DBUSER;
        $dbpassword = self::DBPASSWORD;
        $dbport     = self::DBPORT;

        $heroku_database_url = getenv('DATABASE_URL');

        if ($heroku_database_url) {
            $dbopts = parse_url($heroku_database_url);
            $dbvendor = "pgsql";
            $dbhost = $dbopts["host"];
            $dbname = ltrim($dbopts["path"],'/');
            $dbuser = $dbopts["user"];
            $dbpassword = $dbopts["pass"];
            $dbport = $dbopts["port"];
        }

        try {
            $this->connection = new PDO("{$dbvendor}:host={$dbhost};dbname={$dbname};port={$dbport}", $dbuser, $dbpassword);
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
