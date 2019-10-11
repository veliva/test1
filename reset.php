<?php
include "../config.php";
include "RunSQLQuery.php";

$resetTable = new RunSQLQuery();
$resetTable->db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
$resetTable->stmtname = "truncateTable";
$resetTable->prepared_sql_query = 'TRUNCATE "'.$_COOKIE['user'].'" RESTART IDENTITY;';
$resetTable->sql_query_values = array();

$resetTable->executeQuery();

pg_close($resetTable->db_connection);

header("Location: main.php");
?>