<!DOCTYPE html>
<html lang=en>
<head>
<meta charset="UTF-8">
<title>Daniel Shevtsov - University of Regina</title>
</head>
<body>

<?php
//Function test_input() trims spaces and slashes from user input.
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// define variables and set to empty values
$firstname = $lastname = $gender = $address = $currmed = $medconfirm = "";
$input_ok = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstname"])) {
		$input_ok = false;
    	echo "First name is required.<br>";
  	} else {
    	$firstname = test_input($_POST["firstname"]);
  	}
  	
  	if (empty($_POST["lastname"])) {
  		$input_ok = false;
  		echo "Last name is required.<br>";
  	} else {
  		$lastname = test_input($_POST["lastname"]);
  	}
  	
  	if (empty($_POST["gender"])) {
  		$input_ok = false;
  		echo "Gender selection is required.<br>";
  	} else {
  		$gender = $_POST["gender"];
  	}
  	
  	if (empty($_POST["country"])) {
  		$input_ok = false;
  		echo "Country is required.<br>";
  	} else {
  		$country = test_input($_POST["country"]);
  	}
  	
  	if (empty($_POST["address"])) {
  		$input_ok = false;
  		echo "Address is required.<br>";
  	} else {
  		$address = test_input($_POST["address"]);
  	}
  	
  	if (empty($_POST["mh"])) {
  		$input_ok = false;
  		echo "At least one medical history checkbox is required.<br>";
  	}
  	
  	if (empty($_POST["medconfirm"])) {
  		$input_ok = false;
  		echo "Yes/No on medication question is required.<br>";
  	} else {
  		$medconfirm = $_POST["medconfirm"];
  	}
  	
  	if ($medconfirm == "Yes" && empty($_POST["currmed"])) {
  		$input_ok = false;
  		echo "If Yes is selected, you must fill out the current medication text area.<br>";
  	} else if ($medconfirm == "No" && !empty($_POST["currmed"])) {
  		$input_ok = false;
  		echo "If No is selected, the current medication text area must be blank.<br>";
	}else {
  		$currmed = test_input($_POST["currmed"]);
  	}
  	
  	//If all input is ok (input_ok is true), output the user inputs.
  	if($input_ok) {
		echo "<h1>You have entered the following medical information</h1>";
		echo "<p><b>Name:</b> " . $lastname . ", " . $firstname . "</p>";
		echo "<p><b>Gender:</b> " . $gender . "</p>";
		echo "<p><b>Country:</b> " . $country . "</p>";
		echo "<p><b>Address:</b> " . $address . "</p>";
		echo "<p><b>Medical History:</b> ";
		foreach($_POST['mh'] as $selected) {
			echo $selected . " ";
		}
		echo "</p>";
		echo "<p><b>Current Medication:</b> " . $medconfirm . "</p>";
		if($medconfirm == "Yes")
			echo "<p><b>Medication Detail:</b> " . $currmed . "</p>";
	}
}
?>

	<hr/><br/>

	<a href="http://validator.w3.org/check?uri=referer" class="bwlink" id="validlink" target="_blank">
		LINK TO VALIDATION OF THIS PAGE
	</a>
	
	<p>
		<a href="/~shevtsod/index.php">Return to main page.</a>
	</p>
</body>
</html>