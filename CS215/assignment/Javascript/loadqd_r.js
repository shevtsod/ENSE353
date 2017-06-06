/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 5

 Automatic updating of question detail page every 5 pages and insertion of new
 answers. Affects the following pages:
 -question-detail.php
 */

//Bind an event listener to the "question_list" div when it is loaded
window.addEventListener("load", checkAnswers, false);