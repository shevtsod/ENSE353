<?php
//Handles image upload and assigns a unique
//name to each uploaded image based on the time of upload.
//Taken in part from http://www.w3schools.com/php/php_file_upload.asp
//A string image_name is passed by reference - function returns the name of the image.
function upload_image(&$image_name) {

    //Check if a file was uploaded
    if(!isset($_FILES[$image_name])) {
        $uploadOk = 0;
        return $uploadOk;
    }

    $target_dir = "user_upload/";
    $target_file = $target_dir . basename($_FILES[$image_name]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if the image is a real image.
    $check = getimagesize($_FILES[$image_name]["tmp_name"]);

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<p>Uploaded file is not an image.</p>";
        $uploadOk = 0;
    }

    // Limit file size to 1mb
    if ($_FILES[$image_name]["size"] > 1000000) {
        echo "<p>Image must be below 1MB in size.</p>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "<p>Only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }

    //Change image name to a unique name.
    $target_file = $target_dir . 'image_' . date('Y-m-d-H-i-s') . '_' . uniqid() . "." . $imageFileType;

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<p>File was not uploaded.</p>";
        // if everything is ok, try to upload file
    } else {
        move_uploaded_file($_FILES[$image_name]["tmp_name"], $target_file);
        $image_name = $target_file;
        chmod($target_file, 0644);
    }

    return $uploadOk;
}

//Takes a mysql connection and
//validates the sign up form on the page. If form is valid,
//adds user to table UserAccount and sends user to form-login.php.
//If form is invalid, reloads page and shows errors.
function validateSignUp($conn) {
    $email = $username = $password = $passwordc = $month = $day = $year = $bdate = $imgpath = "";
    $success = true;

    //Make sure inputs are correct.
    //Regex copied from JS validation script, see JS files for information.

    //Email
    if (isset($_POST["email"]) && trim($_POST["email"]) != "" &&
        preg_match('/^\w+@\w+[.]\w+$/', $_POST["email"])) {
        $email = $_POST["email"];
    } else {
        echo "<p>Invalid email address format.</p>";
        $success = false;
    }
    //Username
    if (isset($_POST["username"]) && trim($_POST["username"]) != "") {
        $username = $_POST["username"];
    } else {
        echo "<p>Username must not have leading or trailing spaces.</p>";
        $success = false;
    }
    //Password
    if (isset($_POST["password"]) && trim($_POST["password"]) != "" &&
        preg_match('/^\S{8,}$/', $_POST["password"])) {
        $password = $_POST["password"];
    } else {
        echo "<p>Password must be 8 characters or longer and without spaces.</p>";
        $success = false;
    }
    //Password confirm
    if (isset($_POST["passwordc"]) && trim($_POST["passwordc"]) != "") {
        $passwordc = $_POST["passwordc"];
    } else {
        echo "<p>Password confirmation must be filled.</p>";
        $success = false;
    }
    //Match passwords
    if($password != $passwordc) {
        echo "<p>Passwords must match.</p>";
    }
    //Month
    if (isset($_POST["month"]) && trim($_POST["month"]) != "" &&
        preg_match('/^0[1-9]$|^[1-9]$|^1[0-2]$/', $_POST["month"])) {
        $month = $_POST["month"];
    } else {
        echo "<p>BIRTH DATE: Month must be a number from 1 (or 01) to 12.</p>";
        $success = false;
    }
    //Day
    if (isset($_POST["day"]) && trim($_POST["day"]) != "" &&
        preg_match('/^0[1-9]$|^[1-9]$|^1[0-9]$|^2[0-9]$|^3[0-1]$/', $_POST["day"])) {
        $day = $_POST["day"];
    } else {
        echo "<p>BIRTH DATE: Day must be a number from 1 (or 01) to 31.</p>";
        $success = false;
    }
    //Year
    if (isset($_POST["year"]) && trim($_POST["year"]) != "" &&
        preg_match('/^19[0-9][0-9]$|^20[0-1][0-6]$/', $_POST["year"])) {
        $year = $_POST["year"];
    } else {
        echo "<p>BIRTH DATE: Year must be a number from 1900 to 2016.</p>";
        $success = false;
    }
    //Make sure the actual date is a valid Gregorian calendar date before
    //inserting it into the database.
    if(!checkdate($month, $day, $year)) {
        echo "<p>BIRTH DATE: The date entered does not exist.</p>";
        $success = false;
    }

    //Handle uploaded image. Store a string relative path to the image in the database.
    //If no image was uploaded, use the stock user image.
    $imgpath = "image";

    $successimg = upload_image($imgpath);

    if(!$successimg)
        $imgpath = "images/sample_icon.png";

    //If there are errors, quit the function at this stage.
    if(!$success)
        return;

    //If all input is correct, proceed to convert it to a format to store in the database.
    //Convert date variables to a single string
    $bdate = (int)$month . "-" . (int)$day . "-" . $year;

    //Add a new record with these inputs to database.
    $sql = "INSERT INTO UserAccount (U_EMAIL, U_NAME, U_PASS, U_BDATE, U_IMAGE) 
            VALUES ('$email', '$username', '$password', '$bdate', '$imgpath')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.";
    }
    else {
        // Close Database connection
        mysqli_close($conn);
        echo $sql;
        header("Location: form-login.php");
    }
}   //End of validateSignUp()

//Confirms that the user entered valid credentials
//and stores user variables into session variables. If logged in successfully,
//semds user to index.php
function validateLogin($conn) {
    $email = $password = "";
    $success = true;

    //Make sure inputs are correct.
    //Regex copied from JS validation script, see JS files for information.

    if (isset($_POST["email"]) && trim($_POST["email"]) != "" &&
        preg_match('/^\w+@\w+[.]\w+$/', $_POST["email"])) {
        $email = $_POST["email"];
    } else {
        echo "<p>Invalid email address format.</p>";
        $success = false;
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        echo "<p>No password entered.</p>";
        $success = false;
    }

    //If there are errors, quit the function at this stage.
    if(!$success)
        return;

    //Query database for this user and store session variables.

    $sql = "SELECT * FROM UserAccount WHERE U_EMAIL = '$email'";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Database error.");
    }
    else if (mysqli_num_rows($result) == 0) {
        mysqli_free_result($result);
        echo "User does not exist.";
    }
    else {
        //Verify password vs the hashed password stored on the database.

        while ($row = $result->fetch_assoc()) {
            if ($password != $row["U_PASS"]) {
                //Print verification error
                mysqli_free_result($result);
                echo "Password does not match.";
                return;
            } else {
                $_SESSION["user_id"] = $row["U_ID"];
                $_SESSION["username"] = $row["U_NAME"];
                $_SESSION["image"] = $row["U_IMAGE"];
                $_SESSION["loggedin"] = true;
            }
        }

        // Close Database connection
        mysqli_free_result($result);
        mysqli_close($conn);
        header("Location: index.php");
        exit();
    }

}   //End of performLogin()

//Takes a mysql connection and
//validates the question form on the page. If form is valid,
//adds question to table Question and sends user to index.php.
//If form is invalid, reloads page and shows errors.
function validateQuestion($conn) {
    $textarea = $url = "";
    $success = true;

    //Make sure inputs are correct.
    //Regex copied from JS validation script, see JS files for information.

    if (isset($_POST["form_q_input"]) && trim($_POST["form_q_input"]) != "" &&
    strlen($_POST["form_q_input"]) <= 300) {
        $textarea = $_POST["form_q_input"];
    } else {
        echo "<p>Text area cannot be empty or exceed 300 characters.</p>";
        $success = false;
    }
    if (isset($_POST["websitelink"]) && (trim($_POST["websitelink"]) == "" ||
        preg_match('/(^(http|https):\/\/[^\s\.]+\.[^\s]{2,}$|^www\.[^\s]+\.[^\s]{2,}$)/', $_POST["websitelink"]))) {
        $url = $_POST["websitelink"];
    } else {
        echo "<p>Website URL must be either empty or in a valid URL format and without leading or trailing spaces.</p>";
        $success = false;
    }

    //If there are errors, quit the function at this stage.
    if(!$success)
        return;

    //Add a new record with these inputs to database.
    $sql = "INSERT INTO Question (Q_BODY, Q_URL, Q_TIME, Q_ANSWERS, Q_U_ID)
           VALUES ('$textarea', '$url', '". date('j-n-Y') ."', '0', '" . $_SESSION["user_id"] . "')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.";
    }
    else {
        // Close Database connection
        mysqli_close($conn);
        header("Location: index.php");
        exit();
    }
}   //End of validateQuestion()

//Takes a mysql connection and
//validates the answer form on the page. If form is valid,
//adds answer to table Answer and sends user to index.php.
//If form is invalid, reloads page and shows errors.
function validateAnswer($conn) {
    $textarea = $url = "";
    $success = true;

    //Make sure inputs are correct.
    //Regex copied from JS validation script, see JS files for information.
    if (isset($_POST["form_a_input"]) && trim($_POST["form_a_input"]) != "" &&
        strlen($_POST["form_a_input"]) <= 800) {
        $textarea = $_POST["form_a_input"];
    } else {
        echo "<p>Text area cannot be empty or exceed 800 characters.</p>";
        $success = false;
    }
    if (isset($_POST["websitelink"]) && (trim($_POST["websitelink"]) == "" ||
            preg_match('/(^(http|https):\/\/[^\s\.]+\.[^\s]{2,}$|^www\.[^\s]+\.[^\s]{2,}$)/', $_POST["websitelink"]))) {
        $url = $_POST["websitelink"];
    } else {
        echo "<p>Website URL must be either empty or in a valid URL format and without leading or trailing spaces.</p>";
        $success = false;
    }

    if(!isset($_GET["q"]))
        $success = false;

    //If there are errors, quit the function at this stage.
    if(!$success)
        return;

    //Add a new record with these inputs to database.
    $sql = "INSERT INTO Answer (A_BODY, A_URL, A_LIKES, A_Q_ID, A_U_ID)
           VALUES ('$textarea', '$url', '0', '" . $_GET["q"] . "','"
           . $_SESSION["user_id"] . "')";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.";
    }
    else {
        //Increment answers for the associated question
        $sql = "UPDATE Question SET Q_ANSWERS = Q_ANSWERS + 1 WHERE
           Q_ID = " . $_GET["q"];

        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.";
        }
        else {
            // Close Database connection
            mysqli_close($conn);
            header("Location: index.php");
            exit();
        }
    }
}   //End of validateQuestion()