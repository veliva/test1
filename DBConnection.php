<?php
include '../config.php';
class Database extends DatabaseConfig {
    private $pdo;

    public function __construct() {
        try{
            $this->pdo = new PDO("pgsql:dbname=$this->serverDBName;host=$this->serverHost", $this->serverUser, $this->serverPassword);
        } catch(PDOException $e) {
            die ('DB Error');
        }
    }

    public function runQuery($query, $parameters = array()) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}

$dbconn = new Database();

?>