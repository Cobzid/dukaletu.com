<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=daraja", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>;