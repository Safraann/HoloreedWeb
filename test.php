<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "Holoreed";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE User (
Id INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255),
Forname VARCHAR(255),
Username VARCHAR(255) UNIQUE,
Password VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table User created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
