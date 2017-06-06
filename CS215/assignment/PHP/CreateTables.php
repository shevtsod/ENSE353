<?php
// Create a MySQL database connection:

$username = "shevtsod";
$password = "Ds1234#";
$databasename = $username;

$conn = mysqli_connect("localhost", $username, $password, $databasename);

// Check connection:
// if failed to establish a connection, then exit the php program

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Create table UserAccount
$sql = "
CREATE TABLE UserAccount (
U_ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
U_EMAIL VARCHAR(255) NOT NULL,
U_NAME VARCHAR(255) NOT NULL,
U_PASS VARCHAR(255) NOT NULL,
U_BDATE VARCHAR(255) NOT NULL,
U_IMAGE VARCHAR(255)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table UserAccount created successfully<br/>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br/>";
}

//Create table Question
$sql = "
CREATE TABLE Question (
Q_ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Q_BODY TEXT NOT NULL,
Q_URL TEXT,
Q_TIME VARCHAR(255) NOT NULL,
Q_ANSWERS INT UNSIGNED NOT NULL,

Q_U_ID INT(9) UNSIGNED,
CONSTRAINT fk1 FOREIGN KEY (Q_U_ID) REFERENCES UserAccount (U_ID)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Question created successfully<br/>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br/>";
}

//Create table Answer
$sql = "
CREATE TABLE Answer (
A_ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
A_BODY TEXT NOT NULL,
A_URL TEXT,
A_LIKES INT NOT NULL,

A_Q_ID INT(9) UNSIGNED,
A_U_ID INT(9) UNSIGNED,
CONSTRAINT fk2 FOREIGN KEY (A_Q_ID) REFERENCES Question (Q_ID),
CONSTRAINT fk3 FOREIGN KEY (A_U_ID) REFERENCES UserAccount (U_ID)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Answer created successfully<br/>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br/>";
}

//Create table Like
$sql = "
CREATE TABLE A_Like (
L_ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

L_A_ID INT(9) UNSIGNED,
L_U_ID INT(9) UNSIGNED,
CONSTRAINT fk4 FOREIGN KEY (L_A_ID) REFERENCES Answer (A_ID),
CONSTRAINT fk5 FOREIGN KEY (L_U_ID) REFERENCES UserAccount (U_ID)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Like created successfully<br/>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br/>";
}

//Create table Dislike
$sql = "
CREATE TABLE A_Dislike (
D_ID INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

D_A_ID INT(9) UNSIGNED,
D_U_ID INT(9) UNSIGNED,
CONSTRAINT fk6 FOREIGN KEY (D_A_ID) REFERENCES Answer (A_ID),
CONSTRAINT fk7 FOREIGN KEY (D_U_ID) REFERENCES UserAccount (U_ID)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Dislike created successfully<br/>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br/>";
}

// Close Database connection
mysqli_close($conn);