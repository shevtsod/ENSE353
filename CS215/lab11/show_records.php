<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 30%;
    border-collapse: collapse;
    border-
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {
	text-align: center;
	background-color: grey;
}
</style>
</head>
<body>

<?php
/**
 * Create a table from a user query.
 * @param $conn =	MySQL connection reference 
 * 		  $str =	String from URL
 * @return Output table from databse query
 **/ /*
function generateTable($conn, $str) {
	
	//Form the query
	$sql = "SELECT * FROM Person
			WHERE LastName LIKE '$str%'";
	
	//Query the database
	if ($result = mysqli_query($conn, $sql)) {
		echo "<table>
			<tr>
 			<th>ID</th>
			<th>Firstname</th>
			<th>Lastname</th>
			</tr>";
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['ID'] . "</td>";
			echo "<td>" . $row['FirstName'] . "</td>";
			echo "<td>" . $row['LastName'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}
}

//Get string from URL
$str = $_GET["q"];

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
generateTable($conn, $str);

// Close Database connection
mysqli_close($conn);
*/ ?>
</body>
</html>