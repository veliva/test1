<?php
include "../config.php";
include "RunSQLQuery.php";

$updateRow = new RunSQLQuery();
    
$updateRow->db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
$updateRow->stmtname = "updateRow";
$updateRow->prepared_sql_query = 'UPDATE "'.$_COOKIE['user'].'" SET key = ($1),value=($2) WHERE "id" = ($3);';
$updateRow->sql_query_values = array($_POST['key'], $_POST['value'], $_GET['id']);

$updateRow->executeQuery();

pg_close($updateRow->db_connection);

header("Location: main.php");

?>