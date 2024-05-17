<?php
namespace dbconnection;

use mysqli;

$envPath = realpath(dirname(__FILE__) . '/../.env');
$env = parse_ini_file($envPath);

if (!$env) {
  die('Failed to read .env file');
}
$servername = $env["DB_CONNECTION"];
$username = $env["DB_USERNAME"];
$password = $env["DB_PASSWORD"];
$dbName = $env["DB_NAME"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Database connection failed " . $conn->connect_error);
}