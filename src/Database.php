<?php

namespace app;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = json_decode(file_get_contents(__DIR__ . '/../config/config.json'), true);

        $dbHost = $config['database']['db_host'];
        $dbName = $config['database']['db_name'];
        $dbUser = $config['database']['db_username'];
        $dbPassword = $config['database']['db_password'];

        $dsn = "mysql:host={$dbHost};dbname={$dbName}";

        try {
            $this->connection = new PDO($dsn, $dbUser, $dbPassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
