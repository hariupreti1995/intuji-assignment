<?php
include ("connection/mysqlconnection.php");
$dbName = "eventer";
$dropdb = "DROP DATABASE $dbName";
$sql = "CREATE DATABASE $dbName";
if ($conn->query($dropdb) === TRUE && $conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
    //Create require table once database is created
    $tableQuery = "create table events(ID int primary key,event_name text,event_description TEXT,location TEXT,date TEXT);";
    $conn->select_db($dbName);
    if ($conn->query($tableQuery) === TRUE) {
        echo "Event table created successfully\n\n";
    }
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();