<?php
$env = parse_ini_file(".env");
$servername = $env["DB_CONNECTION"];
$username = $env["DB_USERNAME"];
$password = $env["DB_PASSWORD"];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Database connection failed " . $conn->connect_error);
}