/*
 Daniel Shevtsov
 SID: 200351253
 Class: CS215
 Assignment 3

 Form validation DOM2 registration for Question Cards website. Applies to the following pages:
 -form_login.html
 -form_signup.html
 -form_question.html
 -form_answer.html
 */

//If getElementById did not return null, these elements were found
//Assign DOM2 event registration to these elements

//Submit button

if(document.getElementById("submit")) {
    document.getElementById("submit").addEventListener("click", validateSubmit, false);
}

/* form_login.html , form_signup.html */

//Email
if(document.getElementById("email"))
    document.getElementById("email").addEventListener("blur", validateEmail, false);
//Username
if(document.getElementById("username"))
    document.getElementById("username").addEventListener("blur", validateUsername, false);
//Password
if(document.getElementById("password"))
    document.getElementById("password").addEventListener("blur", validatePassword, false);
//Confirm password when either password or confirm password are changed
if(document.getElementById("password"))
    document.getElementById("password").addEventListener("blur", validatePasswordc, false);
if(document.getElementById("passwordc"))
    document.getElementById("passwordc").addEventListener("blur", validatePasswordc, false);
//Date of Birth
if(document.getElementById("month"))
    document.getElementById("month").addEventListener("blur", validateMonth, false);
if(document.getElementById("day"))
    document.getElementById("day").addEventListener("blur", validateDay, false);
if(document.getElementById("year"))
    document.getElementById("year").addEventListener("blur", validateYear, false);

/* form_login.html , form_signup.html */

//Question textarea
if(document.getElementById("form_q_input"))
    document.getElementById("form_q_input").addEventListener("keyup",
        function(event) { validateTextarea(event, 300) }, false);
//Answer textarea
if(document.getElementById("form_a_input"))
    document.getElementById("form_a_input").addEventListener("keyup",
        function(event) { validateTextarea(event, 800) }, false);
//Website URL
if(document.getElementById("websitelink"))
    document.getElementById("websitelink").addEventListener("blur", validateURL , false);