<?php
//Start session on every page, if got logout request in POST,
//destroy session and return to index page.
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["logout"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--meta charset="UTF-8"-->
    <title>Question Cards</title>
    <link rel="stylesheet" type="text/css" href="CSS/sitestyle.css"/>
    <!--Script to periodically update this page using AJAX-->
    <script type="text/javascript" src="Javascript/loadindex.js"></script>
</head>
<body>

<?php include "PHP/header.php" ?>

<!-- Page content starts here -->

<div id="submit_question">
    <?php
    //If logged in, allow user to submit new question. Otherwise, print a notification.
    if(isset($_SESSION["loggedin"])) {
        echo "<a class=\"q_questionlink\" href=\"form-question.php\">Submit a new question</a>";
    }
    else {
        echo "<p class='centertext'>You must be logged in to submit a question.</p>";
    }
    ?>
</div>

<ul id="question_list">
</ul>

<!-- Page content ends here -->

<!--Script to periodically update this page using AJAX-->
<script type="text/javascript" src="Javascript/loadindex_r.js"></script>

<?php include "PHP/footer.php" ?>

</body>
</html>