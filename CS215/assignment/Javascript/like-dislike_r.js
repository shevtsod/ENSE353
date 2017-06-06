/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 3

 Like-dislike button DOM2 registration for Question Cards website. Applies to the following pages:
    -question-detail.html
 */

//If getElementById did not return null, these elements were founda
//Assign DOM2 event registration to these elements

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