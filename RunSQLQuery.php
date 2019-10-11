<?php

class RunSQLQuery {
    public $db_connection;
    public $stmtname;
    public $prepared_sql_query;
    public $sql_query_values;

    function executeQuery() {
        $result = pg_prepare($this->db_connection, $this->stmtname, $this->prepared_sql_query);
        $result = pg_execute($this->db_connection, $this->stmtname, $this->sql_query_values);
    }
    #separate prepare and execute functions are for looping
    function prepareLoop() {
        $result = pg_prepare($this->db_connection, $this->stmtname, $this->prepared_sql_query);
    }

    function executeLoop() {
        $result = pg_execute($this->db_connection, $this->stmtname, $this->sql_query_values);
    }
}

?>