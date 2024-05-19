<?php
include 'connection/mysqlconnection.php';

if ($conn->ping()) {
    // Query to check if the database exists
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dropdb = "DROP DATABASE $dbName";
        $conn->query($dropdb);
    }
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully\n";
        //Create require table once database is created
        $eventsTableQuery = "
    CREATE TABLE `events` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description` text COLLATE utf8_unicode_ci NOT NULL,
        `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `date` date NOT NULL,
        `time_from` time NOT NULL,
        `time_to` time NOT NULL,
        `google_calendar_event_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `html_link` text COLLATE utf8_unicode_ci DEFAULT NULL,
        `created` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $conn->select_db($dbName);
        if ($conn->query($eventsTableQuery) === TRUE) {
            echo "Event table created successfully\n";
            $integrationTableQuery = "
        CREATE TABLE `integrations` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `data`  text COLLATE utf8_unicode_ci NOT NULL,
        `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `token` text COLLATE utf8_unicode_ci NOT NULL,
        `created` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            if ($conn->query($integrationTableQuery) === TRUE) {
                echo "Integration table created successfully\n\n";
            }
        }
    }
} else {
    echo "Error: " . $conn->error;
}
$conn->close();