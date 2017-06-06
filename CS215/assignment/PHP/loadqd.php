<?php
session_start();

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

$answerArray = array();
generateAnswersAJAX($conn, $answerArray);

echo json_encode($answerArray);

// Close Database connection
mysqli_close($conn);

class question_ans {
    public $a_u_image;
    public $a_u_name;
    public $a_body;
    public $a_url;

    public $up_href;
    public $up_class;
    public $up_src;

    public $down_href;
    public $down_class;
    public $down_src;

    public $numlikes;
}

//Take mysql connection and an array by reference and generate
//list tags dynamically to populate the index page.
//Answered questions and unanswered questions have different
//link tag formats.
//Passes results into an array to be converted to a JSON object
//anc communicated to the client via AJAX.
//Note: Link to question uses GET (question ID stored in URL)
function generateAnswersAJAX($conn, &$array) {
    $q_id = null;
    $result = $result2 = null;

    //Store the URL question ID in a variable
    if(isset($_GET["q"]))
        $q_id = htmlspecialchars($_GET["q"]);
    else
        die("<p class='centertext'>Error: Invalid question ID entered</p>");
    
    //Query database for a list of answers to this question ordered by number of likes.
    $sql = "SELECT * FROM Answer
            JOIN Question ON Q_ID = '$q_id'
            JOIN UserAccount ON U_ID = A_U_ID
            WHERE A_Q_ID = '$q_id'
            ORDER BY A_LIKES DESC;";
    $result = mysqli_query($conn, $sql);

    if(!$result)
        die ("Error: " . $sql . " " . mysqli_error($conn) . "<br/><br/>Aborting.");

    //Insert number of answers into the first index of the array.
    array_push($array, mysqli_num_rows($result));

    if (mysqli_num_rows($result) != 0) {
        //Loop through the array of results and create an object for each element
        while($row = $result->fetch_assoc()) {
            $answer = null;
            $answer = new question_ans;
            $answer->a_u_image = $row["U_IMAGE"];
            $answer->a_u_name = $row["U_NAME"];
            $answer->a_body = $row["A_BODY"];

            //Insert answer controls for this answer
            printAnswerControlsAJAX($conn, $row["A_ID"], $answer);

            //Insert this answer into the array
            array_push($array, $answer);

        }   //End of while
        if($result)
            mysqli_free_result($result);
    }   //End of else
}   //End of generateAnswersAJAX()

/*
 * Take mysql connection and id of user in session and print the 'controls'
 * for an answer consisting of a like button, dislike button, and number of likes.
 */
function printAnswerControlsAJAX($conn, $a_id, &$object) {
    $result2 = null;

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

    //Object passed by reference is now encoded with this information.
}