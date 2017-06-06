<?php

/* FUNCTIONS */

/**
 * Add a record to the table from a user input.
 **/ /*
function addRecord($conn) {
	$user_id = $_POST["ID"];
	$user_firstname = $_POST["FirstName"];
	$user_lastname = $_POST["LastName"];
	
	
	//Form the query
	$sql = "INSERT INTO Person (ID, FirstName, LastName) 
	VALUES ('$user_id', '$user_firstname', '$user_lastname')";
	
	//Query the database
	mysqli_query($conn, $sql);
} */

/**
 * Create a table from a user query.
 **/ /*
function generateTable($conn) {
	$column = $_POST["radiobutton"];
	$searchname = $_POST["Searchname"];
	
	//Form the query
	if($searchname == "*")
		$sql = "select * from Person";
	else
		$sql = "select * from Person 
		WHERE " . $column . " = " . "'" . $searchname . "'";
	
	//Query the database
	$result = mysqli_query($conn, $sql);
	
	$sResp[] =  array("errormsg" => $sql, "sql" => $sql);
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$sRow["id"]=$row["ID"];
		$sRow["fn"]=$row["FirstName"];
		$sRow["ln"]=$row["LastName"];
		$sResp[] = $sRow;
	}
	echo json_encode($sResp);
} */

/****************************************************************************/ /*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
	
	//Perform action
	if(isset($_POST["Add"])) {
		addRecord($conn);
	}
	else if(isset($_POST["Query"])) {
		generateTable($conn);
	}
}

// Close Database connection
mysqli_close($conn);
*/ ?>