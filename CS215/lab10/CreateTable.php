<?php
// Create a MySQL database connection:

$username = "shevtsod";
$password = "****";
$databasename = $username;

$conn = mysqli_connect("localhost", $username, $password, $databasename);

// Check connection:
// if failed to establish a connection, then exit the php program

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

//Create Table
$sql = "CREATE TABLE Person (
ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FirstName VARCHAR(30) NOT NULL,
LastName VARCHAR(30) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
	echo "Table Person created successfully";
} else {
	echo "Error creating table: " . mysqli_error($conn);
}

// Close Database connection
mysqli_close($conn);
?>