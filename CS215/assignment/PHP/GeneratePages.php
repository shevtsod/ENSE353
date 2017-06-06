<?php
//Take mysql connection and generate
//question detail page. The question detail page
//consists of the question and a list of answers
//Question ID is taken from the URL (GET) and special characters are stripped
//Only question is generated here. Answers are generated and updated using AJAX.
//See loadqd.php for AJAX calls.
function generateQuestionDetail($conn) {
    $q_id = null;
    $q_firstans = true;
    $result = $result2 = null;

    //Store the URL question ID in a variable
    if(isset($_GET["q"]))
        $q_id = htmlspecialchars($_GET["q"]);
    else
        die("<p class='centertext'>Error: Invalid question ID entered</p>");

    //Query database for this question.
    $sql = "SELECT * FROM Question 
            JOIN UserAccount WHERE Q_U_ID = U_ID
            AND Q_ID = '$q_id' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(!$result || $result->num_rows == 0)
        die("<p class='centertext'>Error: Invalid question ID entered</p>");

    while($row = $result->fetch_assoc()) {
        echo "
        <li>
            <div class=\"question_ans\">
                <img class=\"user_image\" alt=\"user_image\" src=\"" . $row["U_IMAGE"] . "\"/>
                <p class=\"q_ask\">" . $row["U_NAME"] ." Asked:</p>
                <p class=\"q_text\">" . $row["Q_BODY"] ."</p>
                <div class=\"q_date\">
                    <p>" . $row["Q_TIME"] ."</p>
                </div>
                <div class=\"q_no_of_ans\">
                    <p id='numans'>A: " . $row["Q_ANSWERS"] ."</p>
                </div>
                <div id='q_answer_list_wrapper'>
        ";
    }   //End of while
    if($result)
        mysqli_free_result($result);

    echo "
            </div>
        </li>
";

}   //End of generateQuestionDetail()