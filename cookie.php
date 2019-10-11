<?php
include "../config.php";
include "RunSQLQuery.php";

if (!isset($_COOKIE['user'])){
    $userUniqueCookie = uniqid("",TRUE);
    setcookie('user', $userUniqueCookie, time()+86400);

    $cookieAdd = new RunSQLQuery();

    //cookie to users table
    $cookieAdd->db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
    $cookieAdd->stmtname = "addCookie";
    $cookieAdd->prepared_sql_query = 'INSERT INTO "users"(cookie_name, last_accessed) VALUES ($1, $2)';
    $cookieAdd->sql_query_values = array($userUniqueCookie, 'now()');
    $cookieAdd->executeQuery();

    //create table for user data
    $cookieAdd->stmtname = "createUserTable";
    $cookieAdd->prepared_sql_query = '
        CREATE TABLE IF NOT EXISTS "'.$userUniqueCookie.'"(
        id          SERIAL NOT NULL PRIMARY KEY,
        key         TEXT,
        value       TEXT
        );
    ';
    $cookieAdd->sql_query_values = array();
    $cookieAdd->executeQuery();

    pg_close($cookieAdd->db_connection);

    header("Location: main.php");
} else {
    setcookie('user', $_COOKIE['user'], time()+86400);
    $updateCookieTime = new RunSQLQuery();
    $updateCookieTime->db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
    $updateCookieTime->stmtname = "updateCookieLastAccessed";
    $updateCookieTime->prepared_sql_query = 'UPDATE "users" SET last_accessed = now() WHERE cookie_name = ($1)';
    $updateCookieTime->sql_query_values = array($_COOKIE['user']);
    $updateCookieTime->executeQuery();
    pg_close($updateCookieTime->db_connection);
}
?>