/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 5

 Automatic updating of question detail page every 5 pages and insertion of new
 answers. Affects the following pages:
 -question-detail.php
 */

/*
 Check for new answers every 5 seconds and update the page by inserting
 new answers
 */
function checkAnswers (event) {
    //Call function to populate question detail page initially,
    //and then once every 5 seconds.
    newAnswersAJAX();
    setInterval(function() { newAnswersAJAX();}, 5000);
}

/*
 Sends an AJAX request to the server to check for new questions
 */
function newAnswersAJAX () {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        //Make sure request was responded to successfully,
        //and that the like/dislike button has not been pressed already.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //Use Javascript function JSON.parse to parse JSON data.
            var jsonObj = JSON.parse(xmlhttp.responseText);

            //Convert the received JSON into HTML text
            if(jsonObj.length != 0) {
                generateAnswerHTML(jsonObj);
            }
        }
    };
    xmlhttp.open("GET", "PHP/loadqd.php" + location.search , true);
    xmlhttp.send();
}

/*
 Takes the array parsed from JSON and creates HTML tags from its contents.
 */
function generateAnswerHTML (jsonObj) {
    var q_answer_list_wrapper = document.getElementById('q_answer_list_wrapper');
    var q_numans = document.getElementById('numans');
    var qalwu = "";
    var first_ans = true;

    if (jsonObj[0] == 0) {
        //If there are no answers
        qalwu += "<div class='q_noanswer'>\n";
        qalwu += "<p>No answers (yet). Add an answer!</p>\n";
        qalwu += "</div>\n";
    } else {
        //Print all answers
        for (var i = 1; i < jsonObj.length; i++) {
            //If there is at least one answer.

            //Print divider between every question after the first question
            if(first_ans) {
                first_ans = false;
            } else {
                qalwu += "<hr/>\n";
            }

            qalwu += "<div class='q_answer_detail'>\n";
            qalwu += "<img class='user_image' alt='user_image' src='" + jsonObj[i].a_u_image + "'/>\n";
            qalwu += "<p class='q_ask'>" + jsonObj[i].a_u_name + " Answered:</p>\n";
            qalwu += "<p class='q_text_answer'>" + jsonObj[i].a_body + "</p>\n";
            qalwu += "<div class='answer_controls'>\n";
            qalwu += "<a href='" + jsonObj[i].up_href + "'>\n";
            qalwu += "<img alt='a_up' class='" + jsonObj[i].up_class + "' src='" + jsonObj[i].up_src + "'/>\n";
            qalwu += "</a>\n";
            qalwu += "<a href='" + jsonObj[i].down_href + "'>\n";
            qalwu += "<img alt='a_down' class='" + jsonObj[i].down_class + "' src='" + jsonObj[i].down_src + "'/>\n";
            qalwu += "</a>\n";
            qalwu += "<p class='num_likes'>Score: <span>" + jsonObj[i].numlikes + "</span></p>\n";
            qalwu += "</div>\n";
            qalwu += "</div>\n";
        }
    }

    //Output new number of answers
    q_numans.innerHTML = "<p id='numans'>A: " + jsonObj[0] + "</p>";

    //Output HTML into this div
    q_answer_list_wrapper.innerHTML = qalwu;

    //Bind event listeners to the like/dislike buttons.
    var like_buttons = document.getElementsByClassName("a_up");     //Arrray of all elements of classs a_up
    var like_buttons2 = document.getElementsByClassName("a_up_sel");

    var dislike_buttons = document.getElementsByClassName("a_down");
    var dislike_buttons2 = document.getElementsByClassName("a_down_sel");

    for(var m = 0; m < like_buttons.length; m++) {
        like_buttons[m].addEventListener("click", updateLike, false);
    }

    for(var j = 0; j < like_buttons2.length; j++) {
        like_buttons2[j].addEventListener("click", updateLike, false);
    }

    for(var k = 0; k < dislike_buttons.length; k++) {
        dislike_buttons[k].addEventListener("click", updateLike, false);
    }

    for(var l = 0; l < dislike_buttons2.length; l++) {
        dislike_buttons2[l].addEventListener("click", updateLike, false);
    }
}
