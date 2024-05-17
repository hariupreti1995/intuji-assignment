<?php
include ("connection/mysqlconnection.php");
$dropdb = "DROP DATABASE $dbName";
$sql = "CREATE DATABASE $dbName";
if ($conn->query($dropdb) === TRUE && $conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
    //Create require table once database is created
    $tableQuery = "create table events(ID int primary key,event_name text,event_description TEXT,location TEXT,date TEXT);";
    $tableQuery = "
    CREATE TABLE `events` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description` text COLLATE utf8_unicode_ci NOT NULL,
        `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `date` date NOT NULL,
        `time_from` time NOT NULL,
        `time_to` time NOT NULL,
        `google_calendar_event_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `created` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
    ";
    $conn->select_db($dbName);
    if ($conn->query($tableQuery) === TRUE) {
        echo "Event table created successfully\n\n";
    }
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();