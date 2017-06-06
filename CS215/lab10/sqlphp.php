<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
    label {
    	display: inline-block;
    	width: 150px;
    }
    </style>
</head>
<body>

<?php /*

//Function InsertTable allows a new record to be inserted into the database.
function InsertTable($conn) {
	$user_id = $user_firstname = $user_lastname = "";
	
	echo "<h2>Adding to the Database</h2>";

	//Make sure inputs are correct.
	if(isset($_POST["ID"]) && trim($_POST["ID"]) != "") {
		$user_id = $_POST["ID"];
	} else {
		echo "Error: ID input invalid, aborting. ID input was: " . $_POST["ID"];
		return;
	}
	if(isset($_POST["firstname"]) && trim($_POST["firstname"]) != "") {
		$user_firstname = $_POST["firstname"];
	} else {
		echo "Error: First name input invalid, aborting. First name input was: " . $_POST["firstname"];
		return;
	}
	if(isset($_POST["lastname"]) && trim($_POST["lastname"]) != "") {
		$user_lastname = $_POST["lastname"];
	} else {
		echo "Error: Last name input invalid, aborting. Last name input was: " . $_POST["lastname"];
		return;
	}

	//Add a new record with these inputs to database.
	$sql = "INSERT INTO Person (ID, FirstName, LastName) VALUES ('$user_id', '$user_firstname', '$user_lastname')";

	if (mysqli_query($conn, $sql)) {
		echo "1 record successfully added.";
	} else { // if failed to add a new record:
		echo "Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.";
	}
}

//Function SearchTable() allows to query the database and returns a dynamic table corresponding to the query.
function SearchTable($conn) {

	if (isset($_POST["column"]) && isset($_POST["search"])) {
		$sql = "select * from Person WHERE " . $_POST["column"] . " = " . "'" . $_POST["search"] . "'";
	}
	else if($_POST["search"] == '*') {
		$sql = "SELECT * FROM Person";
	}
	else {
		echo "Unrecognized input, aborting.<br/>";
	}

	echo "SQL command is: " . $sql . "<br />";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result)<=0)
	{
		echo "No Records Found.<br />";
		return;
	}

	// (4) Output records into an HTML table:
	echo "<table border=1>";

	// table header:
	echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th></tr>";


	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<tr>";

		echo "<td>" . $row['ID'] . "</td><td>" . $row['FirstName']. "</td><td>". $row['LastName'] . "</td>";

		echo "</tr>";
	}//end while
	echo "</table>";
}

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
	else {
		echo "<p>Connected to database successfully.</p>";
	}
	
	//Execute requested action.
	if (isset($_POST["add"])) {
		InsertTable($conn);
	}
	else if(isset($_POST["query"])) {
		SearchTable($conn);
	}
	
	// Close Database connection
	mysqli_close($conn);
}
*/ ?>

<hr/><br/>

<a href="http://validator.w3.org/check?uri=referer" class="bwlink" id="validlink" target="_blank">
	LINK TO VALIDATION OF THIS PAGE
</a>

<p>
	<a href="/index.php">Return to main page.</a>
</p>
</body>
</html>
-->