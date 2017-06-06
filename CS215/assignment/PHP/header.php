<!-- Note: Using div id instead of HTML5 semantic elements because they are unsupported in XHTML 1.1 -->
<div id="header">
    <a href="index.php">
        <img id="header_logo" alt="logo_header" src="images/logo.jpg"/>
    </a>
    <div id="login_info">
        <?php
        //Show different login block if user is logged in or not.
        //If user is not logged in, they can log in or sign up
        //If user is logged in, show their image, username, and a logout button.
        if(isset($_SESSION["loggedin"])) {
            echo " <img class=\"user_image\" alt=\"user_image\" src=\"" . $_SESSION["image"] . "\"/>";
            echo "<p id=\"user_name\">". $_SESSION["username"] . "</p>";
            echo "<form action=\"index.php\" method='post' id='logout'>";
            echo "<fieldset>";
            echo "<input id=\"user_login\" type=\"submit\" name='logout' value=\"LOGOUT\"/>";
            echo "</fieldset>";
            echo "</form>";
        }
        else {
            echo "<img class=\"user_image\" alt=\"user_image\" src=\"images/sample_icon.png\"/>";
            echo "<p id=\"user_name\">NOT LOGGED IN</p>";
            echo "<a id=\"user_login\" href=\"form-login.php\">LOGIN</a>";
            echo "<a id=\"user_signup\" href=\"form-signup.php\">SIGN UP</a>";
        }
        ?>
    </div>
</div>

<!-- Pushes content below the header -->
<div class="push"></div>
