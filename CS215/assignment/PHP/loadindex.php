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

$questionArray = array();
generateQuestionsAJAX($conn, $questionArray);

echo json_encode($questionArray);

// Close Database connection
mysqli_close($conn);

class question_noans {
    public $u_image;
    public $u_name;
    public $q_body;
    public $q_time;
    public $q_id;
    public $q_numans = 0;
}

class question_ans {
    public $u_image;
    public $u_name;
    public $q_body;
    public $q_time;
    public $q_id;
    public $q_numans;

    public $a_u_image;
    public $a_u_name;
    public $a_body;
}

//Take mysql connection and an array by reference and generate
//list tags dynamically to populate the index page.
//Answered questions and unanswered questions have different
//link tag formats.
//Passes results into an array to be converted to a JSON object
//anc communicated to the client via AJAX.
//Note: Link to question uses GET (question ID stored in URL)
function generateQuestionsAJAX($conn, &$array) {
    //Query database for a list of 10 latest questions, associate the user that asked the question.
    $sql = "SELECT * FROM Question JOIN UserAccount WHERE Q_U_ID = U_ID ORDER BY Q_ID DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        //Loop through the array of results and create an object for each element
        while($row = $result->fetch_assoc()) {
            $question = null;

            //Check if there are any answers to this question, and create the appropriate list item.

            //If there are no answers.
            if ($row["Q_ANSWERS"] == 0) {
                $question = new question_noans;
                $question->u_image = $row["U_IMAGE"];
                $question->u_name = $row["U_NAME"];
                $question->q_body = $row["Q_BODY"];
                $question->q_time = $row["Q_TIME"];
                $question->q_id = $row["Q_ID"];
                
            }   //End of if
            //If there is at least one answer, show top answer as well.
            else {
                $question = new question_ans;
                $question->u_image = $row["U_IMAGE"];
                $question->u_name = $row["U_NAME"];
                $question->q_body = $row["Q_BODY"];
                $question->q_time = $row["Q_TIME"];
                $question->q_id = $row["Q_ID"];
                $question->q_numans = $row["Q_ANSWERS"];

                $sql = "SELECT * FROM Answer
                        JOIN Question ON A_Q_ID = Q_ID 
                        JOIN UserAccount ON A_U_ID = U_ID
                        WHERE A_Q_ID = " . $row["Q_ID"] . "
                        ORDER BY A_LIKES DESC LIMIT 1";
                $result2 = mysqli_query($conn, $sql);

                while($row = $result2->fetch_assoc()) {
                    $question->a_u_image = $row["U_IMAGE"];
                    $question->a_u_name = $row["U_NAME"];
                    $question->a_body = $row["A_BODY"];
                }
                if($result2)
                    mysqli_free_result($result2);
            }   //End of else
            //Insert this question into the array
            array_push($array, $question);

        }   //End of while
        if($result)
            mysqli_free_result($result);
    }   //End of else
}   //End of generateQuestionsAJAX()