<?php
namespace App\Database;

class DB {

    /**
     * Database credentials.
     */
    private static ?string $dbtype = null;
    private static ?string $dbhost = null;
    private static ?string $dbport = null;
    private static ?string $dbname = null;
    private static ?string $dbuser = null;
    private static ?string $dbpass = null;

    /**
     * PDO options.
     */
    private static array $options = [
        \PDO::ATTR_EMULATE_PREPARES      => false,
        \PDO::ATTR_ERRMODE               => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE    => \PDO::FETCH_ASSOC,
    ];

    /**
     * Database connection.
     */
    public static ?\PDO $connection = null;
    
    /**
     * Get the same instance of this class.
     */
    public static function getInstance(): \PDO {
        // Set credentials.
        static::$dbtype = $_ENV['DB_TYPE'];
        static::$dbhost = $_ENV['DB_HOST'];
        static::$dbport = $_ENV['DB_PORT'];
        static::$dbname = $_ENV['DB_NAME'];
        static::$dbuser = $_ENV['DB_USER'];
        static::$dbpass = $_ENV['DB_PASS'];

        // Connect to database.
        if ( is_null(static::$connection) ) {
            static::connect();
        }

        // Return the DB connection instance.
        return static::$connection;
    }

    /**
     * Connect to database.
     */
    private static function connect() {
        try {
            static::$connection = new \PDO(
                static::$dbtype.':host='.static::$dbhost.':'.static::$dbport.';dbname='.static::$dbname, 
                static::$dbuser, 
                static::$dbpass, 
                static::$options
            ); 
        } catch (\PDOException $e) {
            throw new \Exception( 'Connection error: ' . $e->getMessage() );
        }
    }

}