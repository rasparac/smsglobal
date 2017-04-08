<?php


require_once __DIR__ . '/constants.php';

class Connection {

    public $pdo;
    private static $db = null;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if (self::$db === null) {
            self::$db = new Connection();
        }
        return self::$db;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME , DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();
        }
    }

}