/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 3

 Like-dislike button functions for Question Cards website. Applies to the following pages:
 -question-detail.html
 */

//A user can use the like and dislike buttons to vote on answers. When the page loads, the user can
//either like or dislike an answer. If they choose like, the like button becomes unclickable and the
//like count increments to account for the new vote. The dislike button operates similarly. The user can only
//click the opposite button once they clicked one button in case they change their opinion.


//Function updateLike allows the user to click on the like/dislike button if it is clickable and
//updates the number of likes for the answer.
function updateLike(event) {
    likeDislikeAJAX(event);
    event.preventDefault();
}

//Sends an AJAX request when a like or dislike button is pressed. The AJAX method is GET.
//Allows updating likes and dislikes without reloading the entire page.
//This function is called from updateLike() and updateDislike()
function likeDislikeAJAX(event) {
    var xmlhttp = new XMLHttpRequest();
    var imgclass = event.currentTarget.className;
    var answer_controls = event.currentTarget.parentNode.parentNode;
    var answer_controls_updated = "";
    var href = event.currentTarget.parentNode.href;

    xmlhttp.onreadystatechange = function() {
        //Make sure request was responded to successfully,
        //and that the like/dislike button has not been pressed already.
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200
            && imgclass != "a_up_sel" && imgclass != "a_down_sel"
            && imgclass != "a_up disabled" && imgclass != "a_down disabled") {
            //Use Javascript function JSON.parse to parse JSON data.
            var jsonObj = JSON.parse(xmlhttp.responseText);

            //jsonObj variable now contains the data structure.
            answer_controls_updated += "<a href='" + jsonObj.up_href + "'>\n";
            answer_controls_updated += "<img alt='a_up' class='" + jsonObj.up_class + "' src='" + jsonObj.up_src + "'/>\n";
            answer_controls_updated += "</a>\n";
            answer_controls_updated += "<a href='" + jsonObj.down_href + "'>\n";
            answer_controls_updated += "<img alt='a_down' class='" + jsonObj.down_class + "' src='" + jsonObj.down_src + "'/>\n";
            answer_controls_updated += "</a>\n";
            answer_controls_updated += "<p class='num_likes'>Score: <span>" + jsonObj.numlikes + "</span></p>\n";

            //Access div with class .answer_controls and change its innerHTML
            answer_controls.innerHTML = answer_controls_updated;

            //Bind event listeners to the elements.
            //Like / Dislike Buttons
            var like_buttons = document.getElementsByClassName("a_up");     //Arrray of all elements of classs a_up
            var like_buttons2 = document.getElementsByClassName("a_up_sel");

            var dislike_buttons = document.getElementsByClassName("a_down");
            var dislike_buttons2 = document.getElementsByClassName("a_down_sel");

            for(var i = 0; i < like_buttons.length; i++) {
                like_buttons[i].addEventListener("click", updateLike, false);
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
    };
    xmlhttp.open("GET", href , true);
    xmlhttp.send();
}
