/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 5

 Automatic updating of index page every 5 pages and insertion of new
 questions. Affects the following pages:
 -index.html
 */

/*
Check for new questions every 5 seconds and update the page by inserting
new questions
 */
function checkNewQuestions (event) {
    //Call function to populate index page initially, and then once
    //every 5 seconds.
    newQuestionsAJAX();
    setInterval(function() { newQuestionsAJAX();}, 5000);
}

/*
Sends an AJAX request to the server to check for new questions
 */
function newQuestionsAJAX () {
    var xmlhttp = new XMLHttpRequest();
    var questions_list = document.getElementById("question_list");

    xmlhttp.onreadystatechange = function () {
        //Make sure request was responded to successfully,
        //and that the like/dislike button has not been pressed already.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //Use Javascript function JSON.parse to parse JSON data.
            var jsonObj = JSON.parse(xmlhttp.responseText);

            //Convert the received JSON into HTML text
            if(jsonObj.length != 0) {
                generateQuestionHTML(jsonObj, questions_list);
            }
        }
    };
    xmlhttp.open("GET", "PHP/loadindex.php" , true);
    xmlhttp.send();
}

/*
Takes the array parsed from JSON and creates HTML tags from its contents.
 */
function generateQuestionHTML (jsonObj, questions_list) {
    var qlu = "";

    for(var i = 0; i < jsonObj.length; i++)
    {
        qlu += "<li>\n";
        if(jsonObj[i].q_numans == 0)
            qlu += "<div class='question_noans'>\n";
        else
            qlu += "<div class='question_ans'>\n";
        qlu += "<img class='user_image' alt='user_image' src='" + jsonObj[i].u_image + "'/>\n";
        qlu += "<p class='q_ask'>" + jsonObj[i].u_name + " Asked:</p>\n";
        qlu += "<p class='q_text'>" + jsonObj[i].q_body + "</p>\n";
        qlu += "<div class='q_date'>\n";
        qlu += "<p>" + jsonObj[i].q_time + "</p>\n";
        qlu += "</div>\n";
        qlu += "<div class='q_no_of_ans'>\n";
        qlu += "<p>A: " + jsonObj[i].q_numans + "</p>\n";
        qlu += "</div>\n";
        if(jsonObj[i].q_numans == 0) {
            qlu += "<div class='q_noanswer'>\n";
            qlu += "<p>No answers (yet). Add an answer!</p>\n";
            qlu += "</div>\n";
        } else {
            //If there is at least one answer, show top answer as well.
            qlu += "<div class='q_answer'>\n";
            qlu += "<img class='user_image' alt='user_image' src='" + jsonObj[i].a_u_image + "'/>\n";
            qlu += "<p class='q_ask'>" + jsonObj[i].a_u_name + " Asked:</p>\n";
            qlu += "<p class='q_text_answer'>" + jsonObj[i].a_body + "</p>\n";
            qlu += "</div>\n";
        }
        qlu += "<a class='q_answerlink' href='question-detail.php?q=" + jsonObj[i].q_id + "\'>Go to question page</a>\n";
        qlu += "</div>\n";
        qlu += "</li>\n";
    }


    //Output HTML into this div
    questions_list.innerHTML = qlu;
}
