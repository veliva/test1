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

// $test = new Database();
// // $result = $test->getDataFromDB();
// print_r($test->runQuery('SELECT "id", "key", "value", "last_accessed" FROM "keyValueTable" WHERE id=? and value=? and key=?;', array(3, "jkl", "asd123")));
// echo "<br>";
// // $test->runQuery('INSERT INTO "keyValueTable"("key", "value") VALUES (?, ?);', array("üks", "kaks"));
// echo "<br>";
// $result = $test->runQuery('SELECT "id", "key", "value", "last_accessed" FROM "keyValueTable";');
// print_r($result);
?>