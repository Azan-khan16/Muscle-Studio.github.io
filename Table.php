<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php-crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE `crud` (
    `id` int(255) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `contact_no` varchar(255) NOT NULL,
    `gender` varchar(255) NOT NULL,
    `date_of_joining` date NOT NULL,
    `plan` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>