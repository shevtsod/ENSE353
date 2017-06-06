<!--
<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="UTF-8">
    <title>Daniel Shevtsov - University of Regina</title>
    <style>
    	a {
    		color: black;
    	}
    	
    	td {
    	}
    	
    	td p {
    	 	text-align: center;
    	 	margin: 5px 0 10px 0;
    	}
    </style>
</head>
<body style="background-color: <?php echo $_POST["color"] ?>">

<?php /*
	function upload_image ($image_name) {
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES[$image_name]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if the image is a real image.
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES[$image_name]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".<br/>";
				$uploadOk = 1;
			} else {
				echo "File is not an image.<br/>";
				$uploadOk = 0;
			}
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
			$uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "File was not uploaded.<br/>";
			// if everything is ok, try to upload file
		} else {
			move_uploaded_file($_FILES[$image_name]["tmp_name"], $target_file);
			chmod($target_file, 0644);
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//Upload the 4 images from the previous page.
		upload_image ("file1");
		upload_image ("file2");
		upload_image ("file3");
		upload_image ("file4");
		
		//Create table with images and captions
		echo "<table border = 1>";
		echo "<tr>";
		echo "<td><img src=\"uploads/" . basename($_FILES["file1"]["name"]) . "\" alt=\"image1\" width=300px height=200px>
		<p>Caption: " . $_POST["name1"] . "</p></td>";
		echo "<td><img src=\"uploads/" . basename($_FILES["file2"]["name"]) . "\" alt=\"image2\" width=300px height=200px>
		<p>Caption: " . $_POST["name2"] . "</p></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><img src=\"uploads/" . basename($_FILES["file3"]["name"]) . "\" alt=\"image3\" width=300px height=200px>
		<p>Caption: " . $_POST["name3"] . "</p></td>";
		echo "<td><img src=\"uploads/" . basename($_FILES["file4"]["name"]) . "\" alt=\"image4\" width=300px height=200px>
		<p>Caption: " . $_POST["name4"] . "</p></td>";
		echo "</tr>";
		echo "</table>";
	}
*/ ?>

<hr/><br/>

<a href="http://validator.w3.org/check?uri=referer" class="bwlink" id="validlink" target="_blank">
    LINK TO VALIDATION OF THIS PAGE
</a>

<p>
    <a href="/~shevtsod/index.php">Return to main page.</a>
</p>
</body>
</html>
-->