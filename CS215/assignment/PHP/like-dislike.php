<?php
/* Set of functions and classes to deal with like/dislike presses on the question-detail.html page.
 * Queries database for existing like/dislike from the user and updates the like/dislike
 * tables, as well as the answer table.
 * Users can only like or dislike an answer once, but they may change their opinion and dislike
 * a question they previously liked, or like a question they previously disliked.
 */

/* FUNCTIONS  */

/*
 * Takes question ID and answer ID, and submits a like from this user to the database.
 * Updates the answer's number of likes and removes a previous dislike if it is found.
 * Verifies that user is logged in via session variables.
 */
function submitLike($conn, $q_id, $a_id) {
    $prev_dislike = false;

    if (isset($_SESSION["loggedin"])) {
        //Store GET variables safely.
        $q_id = mysqli_real_escape_string($conn, $q_id);
        $a_id = mysqli_real_escape_string($conn, $a_id);

        //Check if the question exists.
        $sql = "SELECT * FROM Question WHERE Q_ID = '$q_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result || $result->num_rows == 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Question does not exist.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the answer exists.
        $sql = "SELECT * FROM Answer WHERE A_ID = '$a_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result || $result->num_rows == 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Answer does not exist.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the user already liked this answer, but somehow managed
        //to press the like button again.
        $sql = "SELECT * FROM A_Like WHERE L_A_ID = '$a_id'
                    AND L_U_ID = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows != 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Attempted to like a question twice.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the user already disliked this answer, and store this information.
        $sql = "SELECT * FROM A_Dislike WHERE D_A_ID = '$a_id'
                    AND D_U_ID = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows == 1) {
            $prev_dislike = true;
        }
        if ($result)
            mysqli_free_result($result);

        //Add a new like record into the likes table.
        $sql = "INSERT INTO A_Like (L_A_ID, L_U_ID)
                    VALUES ('$a_id', '" . $_SESSION['user_id'] . "')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Database error - Cannot add like.</p>");
        }

        //Increment number of likes for this answer in the answer table.
        $sql = "UPDATE Answer SET A_LIKES = A_LIKES + 1 WHERE A_ID = $a_id";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Database error - Cannot increment likes.</p>");
        }

        //Remove a previous dislike if it was determined that one exists.
        if ($prev_dislike) {
            $sql = "DELETE FROM A_Dislike
                        WHERE D_A_ID = '$a_id'
                        AND D_U_ID = '" . $_SESSION['user_id'] . "'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                mysqli_close($conn);
                die("<p class='centertext'>Error: Database error - Cannot remove previous dislike.</p>");
            }
        }
    }   //End of if
}

/*
 * Takes question ID and answer ID, and submits a dislike from this user to the database.
 *  * Updates the answer's number of likes and removes a previous like if it is found.
 * Verifies that user is logged in via session variables.
 */
function submitDislike($conn, $q_id, $a_id) {
    $prev_like = false;

    if (isset($_SESSION["loggedin"])) {
        //Store GET variables safely.
        $q_id = mysqli_real_escape_string($conn, $q_id);
        $a_id = mysqli_real_escape_string($conn, $a_id);

        //Check if the question exists.
        $sql = "SELECT * FROM Question WHERE Q_ID = '$q_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result || $result->num_rows == 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Question does not exist.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the answer exists.
        $sql = "SELECT * FROM Answer WHERE A_ID = '$a_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result || $result->num_rows == 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Answer does not exist.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the user already disliked this answer, but somehow managed
        //to press the dislike button again.
        $sql = "SELECT * FROM A_Dislike WHERE D_A_ID = '$a_id'
                    AND D_U_ID = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows != 0) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Attempted to dislike a question twice.</p>");
        } else {
            mysqli_free_result($result);
        }

        //Check if the user already liked this answer, and store this information.
        $sql = "SELECT * FROM A_Like WHERE L_A_ID = '$a_id'
                    AND L_U_ID = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows == 1) {
            $prev_like = true;
        }
        if ($result)
            mysqli_free_result($result);

        //Add a new like record into the dislikes table.
        $sql = "INSERT INTO A_Dislike (D_A_ID, D_U_ID)
                    VALUES ('$a_id', '" . $_SESSION['user_id'] . "')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Database error - Cannot add dislike.</p>");
        }

        //Decrement number of likes for this answer in the answer table.
        $sql = "UPDATE Answer SET A_LIKES = A_LIKES - 1 WHERE A_ID = $a_id";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            mysqli_close($conn);
            die("<p class='centertext'>Error: Database error - Cannot decrement likes.</p>");
        }

        //Remove a previous dislike if it was determined that one exists.
        if ($prev_like) {
            $sql = "DELETE FROM A_Like
                        WHERE L_A_ID = '$a_id'
                        AND L_U_ID = '" . $_SESSION['user_id'] . "'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                mysqli_close($conn);
                die("<p class='centertext'>Error: Database error - Cannot remove previous like.</p>");
            }
        }
    }   //End of if
}

/*
 * Take mysql connection and id of user in session and print the 'controls'
 * for an answer consisting of a like button, dislike button, and number of likes.
 */
function printAnswerControlsAJAX($conn, $a_id) {
    $result2 = null;
    $object = new likeDislikeJSON();

    //Store the URL question ID in a variable
    if(isset($_GET["q"]))
        $q_id = htmlspecialchars($_GET["q"]);
    else
        die("<p class='centertext'>Error: Invalid question ID entered</p>");

    //Store answer ID in a variable and submit the like/dislike to database.
    if($a_id == null) {
        if (isset($_GET["l"])) {
            $a_id = $_GET["l"];
            submitLike($conn, $q_id, $a_id);
        } else if (isset($_GET["d"])) {
            $a_id = $_GET["d"];
            submitDislike($conn, $q_id, $a_id);
        }
    }

    //Print like button. Check database if user liked this answer and load appropriate image.
    if(isset($_SESSION["loggedin"])) {
        $sql = "SELECT * FROM A_Like
                        WHERE L_A_ID = " . $a_id . "
                        AND L_U_ID = " . $_SESSION["user_id"];
        $result2 = mysqli_query($conn, $sql);
    }

    if(isset($_SESSION["loggedin"]) && $result2->num_rows != 0) {
        //If there was a like found from this user on this question, print selected arrow.
        $object->up_href = "#";
        $object->up_class = "a_up_sel";
        $object->up_src = "images/arrow-up-selected.png";
    } else if (isset($_SESSION["loggedin"])) {
        //If there wasn't a like found from this user on this question, print unselected arrow.
        $object->up_href = "PHP/like-dislike-AJAX.php/?q=$q_id&l=$a_id";
        $object->up_class = "a_up";
        $object->up_src = "images/arrow-up.png";
    } else if (!isset($_SESSION["loggedin"])) {
        //If user is not logged in, print disabled arrow.
        $object->up_href = "#";
        $object->up_class = "a_up disabled";
        $object->up_src = "images/arrow-up.png";
    }

    if($result2)
        mysqli_free_result($result2);

    //Print dislike button. Check database if user disliked this answer and load appropriate image.
    if(isset($_SESSION["loggedin"])) {
        $sql = "SELECT * FROM A_Dislike
                        WHERE D_A_ID = " . $a_id . "
                        AND D_U_ID = " . $_SESSION["user_id"];
        $result2 = mysqli_query($conn, $sql);
    }

    if(isset($_SESSION["loggedin"]) && $result2->num_rows != 0) {
        //If there was a like found from this user on this question, print selected arrow.
        $object->down_href = "#";
        $object->down_class = "a_down_sel";
        $object->down_src = "images/arrow-down-selected.png";
    } else if (isset($_SESSION["loggedin"])) {
        //If there wasn't a like found from this user on this question, print unselected arrow.
        $object->down_href = "PHP/like-dislike-AJAX.php/?q=$q_id&d=$a_id";
        $object->down_class = "a_down";
        $object->down_src = "images/arrow-down.png";
    } else if (!isset($_SESSION["loggedin"])) {
        //If user is not logged in, print disabled arrow.
        $object->down_href = "#";
        $object->down_class = "a_down disabled";
        $object->down_src = "images/arrow-down.png";
    }
    if($result2) {
        mysqli_free_result($result2);
    }

    $sql = "SELECT * FROM Answer WHERE A_ID = " . $a_id;
    $result2 = mysqli_query($conn, $sql);

    while($row = $result2->fetch_assoc()) {
        $object->numlikes = $row["A_LIKES"];
    }

    if($result2) {
        mysqli_free_result($result2);
    }

    //Encode $object into JSON and echo it.
    echo json_encode($object);
}

/* CLASSES */

class likeDislikeJSON {
    public $up_href;
    public $up_class;
    public $up_src;

    public $down_href;
    public $down_class;
    public $down_src;

    public $numlikes;
}