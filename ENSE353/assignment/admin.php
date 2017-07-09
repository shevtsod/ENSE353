<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <meta name="theme-color" content="#000000">
    <title>Daniel Shevtsov</title>
    <link rel="stylesheet" type="text/css" href="css/assignment.css">
</head>
<body>

<h1>Subscription Service</h1>
<h2>Administrator Panel</h2>

<div class="content" id="form-login">
    <?php
        //Ensure that the current user is the administrator, otherwise prohibit access to this page
        if(!isset($_SESSION['email']) || $_SESSION['email'] != "admin@subscription-service.com") {
            echo "<p><b>Access Prohibited</b></p>";
            echo "\n</div></body></html>";
            die();
        }

        require_once 'phpClass/SQLQuery.php';

        $sql = new sqlQuery;
        $users = $sql->getUsers();

        //Print a table with all the users
        echo "<div style=\"overflow-x: auto;\"><table>";
        echo "<tr><th colspan=\"3\"></th><th colspan=\"4\">Subscription Options</th></tr>";
        echo "<tr><th>ID</th><th>Email</th><th>Verified</th><th>Option A</th><th>Option B</th><th>Option C</th><th>Manage</th></tr>";

        $i = 0;

        while(isset($users[$i])) {
            echo "<tr><td>" . $users[$i]['id'] . "</td>";

            echo "<td>" . $users[$i]['email'] . "</td>";

            $active = $users[$i]['active'] ? "checked" : "";
            echo "<td><input type=\"checkbox\" " . $active . " readonly onclick=\"event.preventDefault()\"></td>";

            $optionA = $users[$i]['optionA'] ? "checked" : "";
            echo "<td><input type=\"checkbox\" " . $optionA . " readonly onclick=\"event.preventDefault()\"></td>";

            $optionB = $users[$i]['optionB'] ? "checked" : "";
            echo "<td><input type=\"checkbox\" " . $optionB . " readonly onclick=\"event.preventDefault()\"></td>";

            $optionC = $users[$i]['optionC'] ? "checked" : "";
            echo "<td><input type=\"checkbox\" " . $optionC . " readonly onclick=\"event.preventDefault()\"></td>";

            echo "<td><form method=POST action=\"subscriptions.php\">" .
                "<input type=\"hidden\" name=\"email\" value=\"" . $users[$i]['email'] . "\">" .
                "<input type=\"submit\" value=\"Edit\"></form></td>";

            echo "</tr>";
            $i++;
        }
        echo "</table></div>";

        if($i == 0)
            echo "There are currently no users.";
    ?>

    <a href="logout.php">Click here to log out and return to the main page</a>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
