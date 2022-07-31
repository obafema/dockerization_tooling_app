<?php

//connect .env file

require_once realpath(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// enabling environment variable for php


$servername = "127.0.0.1"; // input servername
$username = "userconnect"; // input username
$password = "zigali"; //input password
$dbname = "toolingdb"; // input dbname


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>