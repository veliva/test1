<?php
include "../config.php";
include "RunSQLQuery.php";

if(isset($_GET['rowNumber'])){
    $deleteRow = new RunSQLQuery();
    
    $deleteRow->db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
    $deleteRow->stmtname = "deleteRow";
    $deleteRow->prepared_sql_query = 'DELETE FROM "'.$_COOKIE['user'].'" WHERE "id" =($1);';
    $deleteRow->sql_query_values = array($_GET['rowNumber']);

    $deleteRow->executeQuery();

    pg_close($deleteRow->db_connection);

    header("Location: main.php");
}

?>