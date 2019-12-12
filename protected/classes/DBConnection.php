<?php
class Database {
    private $pdo;

    public function __construct($serverDBName, $serverHost, $serverUser, $serverPassword) {
        try{
            $this->pdo = new PDO("pgsql:dbname=$serverDBName;host=$serverHost", $serverUser, $serverPassword);
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

?>