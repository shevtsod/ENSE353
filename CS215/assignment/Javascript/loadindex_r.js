/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 5

 Automatic updating of index page every 5 pages and insertion of new
 questions. Affects the following pages:
 -index.html
 */

//Bind an event listener to the "question_list" div when it is loaded
window.addEventListener("load", checkNewQuestions, false);