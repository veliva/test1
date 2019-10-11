<?php
include "../config.php";
class Add{
    public $db_connection;
    public $stmtname;
    public $prepared_sql_query;
    public $sql_query_values;

    function __construct($db_connection, $stmtname, $prepared_sql_query, $sql_query_values) {
        $this->db_connection = $db_connection;
        $this->stmtname = $stmtname;
        $this->prepared_sql_query = $prepared_sql_query;
        $this->sql_query_values = $sql_query_values;
    }

    function addRow() {
        $result = pg_prepare($this->db_connection, $this->stmtname, $this->prepared_sql_query);
        $result = pg_execute($this->db_connection, $this->stmtname, $this->sql_query_values);

        pg_close($this->db_connection);
    }

}

$sql_tablename = $_COOKIE['user'];
$sql = 'INSERT INTO "'.$sql_tablename.'"(key,value) VALUES ($1, $2)';
$test = new Add(
    pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword),
    "addRow",
    $sql,
    array($_POST['keyAdd'], $_POST['valueAdd'])
);
$test->addRow();

header("Location: main.php");
?>