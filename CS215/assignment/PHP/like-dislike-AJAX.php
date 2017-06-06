<?php
//This page is called from like-dislike.js from function likeDislikeAJAX()
//as an AJAX request

include("like-dislike.php");

session_start();

// Create a MySQL database connection:
$username = "shevtsod";
$password = "Ds1234#";
$databasename = $username;

$conn = mysqli_connect("localhost", $username, $password, $databasename);

// Check connection:
// if failed to establish a connection, then exit the php program

if (!$conn) {
    die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
}

//Print the new answer controls div
printAnswerControlsAJAX($conn, null);

// Close Database connection
mysqli_close($conn);