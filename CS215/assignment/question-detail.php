<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["logout"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--meta charset="UTF-8"-->
    <title>Question Cards</title>
    <link rel="stylesheet" type="text/css" href="CSS/sitestyle.css"/>
    <!--Script to periodically update this page using AJAX-->
    <script type="text/javascript" src="Javascript/loadqd.js"></script>
    <?php
    //Like-dislike button functionality Javascript
    
    echo "<script type=\"text/javascript\" src=\"Javascript/like-dislike.js\"></script>";
    ?>
</head>
<body>

<?php include "PHP/header.php" ?>

<!-- Page content starts here -->

<div id="submit_question">
    <?php
    //If logged in, allow user to submit new question. Otherwise, print a notification.
    if(isset($_SESSION["loggedin"])) {
        echo "<a class=\"q_questionlink\" href=\"form-answer.php?q=" . $_GET["q"] . "\">Answer this question</a>";
    }
    else {
        echo "<p class='centertext'>You must be logged in to submit an answer.</p>";
    }
    ?>
</div>

<ul id="question_list">
    <?php
    //Dynamically populate the questions list from the database.
    include("PHP/GeneratePages.php");

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
    
    //Print the question and a list of answers to the page.
    generateQuestionDetail($conn);

    // Close Database connection
    mysqli_close($conn);
    ?>
</ul>

<!-- Page content ends here -->

<!--Script to periodically update this page using AJAX-->
<script type="text/javascript" src="Javascript/loadqd_r.js"></script>

<?php include "PHP/footer.php" ?>

<?php
//Like-dislike button functionality Javascript DOM 2 Event Registration

echo "<script type=\"text/javascript\" src=\"Javascript/like-dislike_r.js\"></script>";
?>

</body>
</html>