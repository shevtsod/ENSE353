/*
Daniel Shevtsov
SID: 200351253
Class: CS215
Assignment 3

Form validation functions for Question Cards website. Applies to the following pages:
    -form_login.html
    -form_signup.html
    -form_question.html
    -form_answer.html
 */

//Function checkEmptyFields verifies that there are no empty fields in the form.
//Adds an error to the error box otherwise.
//The only exception is the URL field, which may be left empty.

function checkEmptyFields() {
    var error = document.getElementById("error");
    var email = document.getElementById("email");
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var passwordc = document.getElementById("passwordc");
    var month = document.getElementById("month");
    var day = document.getElementById("day");
    var year =  document.getElementById("year");
    var form_q_input = document.getElementById("form_q_input");
    var form_a_input = document.getElementById("form_a_input");
    var error_flag = false;

    //If the element exists on this page (not null) check if it is empty.
    if(email && (email.value == null || email.value == ""))
        error_flag = true;
    if(username && (username.value == null || username.value == ""))
        error_flag = true;
    if(password && (password.value == null || password.value == ""))
        error_flag = true;
    if(passwordc && (passwordc.value == null || passwordc.value == ""))
        error_flag = true;
    if(month && (month.value == null || month.value == ""))
        error_flag = true;
    if(day && (day.value == null || day.value == ""))
        error_flag = true;
    if(year && (year.value == null || year.value == ""))
        error_flag = true;
    if(form_q_input && (form_q_input.value == null || form_q_input.value == ""))
        error_flag = true;
    if(form_a_input && (form_a_input.value == null || form_a_input.value == ""))
        error_flag = true;

    //If found an empty field that exists, create an error message.
    if(error_flag) {
        error.style.visibility="visible";
        if(!document.getElementById("error_empty"))
            error.innerHTML += "<p id=\"error_empty\">Make sure that there are no empty required fields.</p>";

    }
    else {
        if(document.getElementById("error_empty"))
            error.removeChild(document.getElementById("error_empty"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate submit button. If button is pressed while there are errors, prevent form submission.
//This function is called both when the element is hovered on by the mouse and clicked on, so that
//the cursor changes as soon as the element is hovered but the default action of the click is
//prevent when the element is clicked.
function validateSubmit(event) {
    var error = document.getElementById("error");

    checkEmptyFields();

    //Confirm that there are no errors

    if(error.innerHTML!=null && error.innerHTML!="") {
        if(event.type == "click")
            event.preventDefault();
        event.currentTarget.style.cursor="not-allowed";
    }
    else {
        event.currentTarget.style.cursor="default";
    }
}

/* form_login.html , form_signup.html */

//Validate email using regular expression whenever the value is changed in the textbox.
function validateEmail(event) {
    var email=event.currentTarget;
    var error=document.getElementById("error");

    /*
    RegExp:
    -no leading or trailing spaces
    -match one or more word characters
    -match one @
    -match one or more word characters
    -match one .
    -match oen or more word characters
     */
    if(!email.value.match(/^\w+@\w+[.]\w+$/)) {
        /*
        if RegExp is not matched:
        -display red border inside textbox
        -set error box to visible
        -if error_email is not showing already, show it
         */
        email.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_email"))
            error.innerHTML += "<p id=\"error_email\">Invalid email address format.</p>";
    }
    /*
    if RegExp is matched:
    -hide red border inside textbox
    -remove error_email message
    -if error box is empty, hide it
    */
    else {
        email.className = null;
        if(document.getElementById("error_email"))
            error.removeChild(document.getElementById("error_email"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate username using regular expression whenever the value is changed in the textbox.
function validateUsername(event) {
    var username=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match one or more word characters
     */
    if(!username.value.match(/^\w+$/)) {
        username.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_username"))
            error.innerHTML += "<p id=\"error_username\">Username must not have leading or trailing spaces.</p>";
    }
    else {
        username.className = null;
        if(document.getElementById("error_username"))
            error.removeChild(document.getElementById("error_username"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate password using regular expression whenever the value is changed in the textbox.
function validatePassword(event) {
    var password=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match 8 or more non-whitespace characters
     */
    if(!password.value.match(/^\S{8,}$/)) {
        password.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_password"))
            error.innerHTML += "<p id=\"error_password\">Password must be 8 characters or longer and without spaces.</p>";
    }
    else {
        password.className = null;
        if(document.getElementById("error_password"))
            error.removeChild(document.getElementById("error_password"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate password confirm by comparing with password whenever the value is changed in the textbox.
function validatePasswordc(event) {
    var password=document.getElementById("password");
    var passwordc=document.getElementById("passwordc");
    var error=document.getElementById("error");

    /*
     match passwordc with password
     */
    if(passwordc.value != password.value) {
        passwordc.className = "HLerror";
        password.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_passwordc"))
            error.innerHTML += "<p id=\"error_passwordc\">Passwords must match.</p>";
    }
    else {
        passwordc.className = null;
        //Clear the red border on password if it does not have another error.
        if(!document.getElementById("error_password"))
            password.className = null;
        if(document.getElementById("error_passwordc"))
            error.removeChild(document.getElementById("error_passwordc"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate month using regular expression whenever the value is changed in the textbox.
function validateMonth(event) {
    var month=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match 0-9 or 00-12 only
     */
    if(!month.value.match(/^0[1-9]$|^[1-9]$|^1[0-2]$/)) {
        month.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_month"))
            error.innerHTML += "<p id=\"error_month\">BIRTH DATE: Month must be a number from 1 (or 01) to 12.</p>";
    }
    else {
        month.className = null;
        if(document.getElementById("error_month"))
            error.removeChild(document.getElementById("error_month"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate day using regular expression whenever the value is changed in the textbox.
function validateDay(event) {
    var day=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match 0-9 or 00-09 or 10-19 or 20-29 or 30-31 only
     */
    if(!day.value.match(/^0[1-9]$|^[1-9]$|^1[0-9]$|^2[0-9]$|^3[0-1]$/)) {
        day.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_day"))
            error.innerHTML += "<p id=\"error_day\">BIRTH DATE: Day must be a number from 1 (or 01) to 31.</p>";
    }
    else {
        day.className = null;
        if(document.getElementById("error_day"))
            error.removeChild(document.getElementById("error_day"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Validate year using regular expression whenever the value is changed in the textbox.
function validateYear(event) {
    var year=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match 19[00-99] or 20[00-16] only
     */
    if(!year.value.match(/^19[0-9][0-9]$|^20[0-1][0-6]$/)) {
        year.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_year"))
            error.innerHTML += "<p id=\"error_year\">BIRTH DATE: Year must be a number from 1900 to 2016.</p>";
    }
    else {
        year.className = null;
        if(document.getElementById("error_year"))
            error.removeChild(document.getElementById("error_year"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

/* form_login.html , form_signup.html */

//Validate textarea.
function validateTextarea(event, charcount) {
    var textarea = event.currentTarget;
    var error=document.getElementById("error")

    //Update the dynamic character counter
    validateTextareaCharCount(textarea, charcount);

    /* If textarea is either blank or exceeds charcount parameter, show error. */
    if(textarea.value == null || textarea.value == "" || textarea.value.length > charcount) {
        textarea.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_textarea"))
            error.innerHTML += "<p id=\"error_textarea\">Text area cannot be empty or exceed " + charcount + " characters.</p>";
    }
    else {
        textarea.className = null;
        if(document.getElementById("error_textarea"))
            error.removeChild(document.getElementById("error_textarea"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}

//Character counter for textarea. Compares value in textarea to charcount limit
//that was passed in as a parameter. Updates every time a key is pressed.
function validateTextareaCharCount(textarea, charcount) {
    var char_counter = document.getElementById("char_counter");
    
    char_counter.innerHTML = "Character Count: " + textarea.value.length + "/" + charcount;
    //If limit is exceeded, highlight the counter in red text.
    if(textarea.value.length > charcount) {
        char_counter.style.color = "#f5433e";
    }
    else {
        char_counter.style.color = "black";
    }
}

//Validate URL using regular expression whenever the value is changed in the textbox.
function validateURL(event) {
    var url=event.currentTarget;
    var error=document.getElementById("error");

    /*
     RegExp:
     -no leading or trailing spaces
     -match http:// , https://, or none
     -if http:// or https:// , not required to match www. , otherwise match www.
     -match one or more non-whitespace characters
     -match another .
     -match one or more non-whitespace characters
     */
    if(url.value != null && url.value != "" && !url.value.match(/(^(http|https):\/\/[^\s\.]+\.[^\s]{2,}$|^www\.[^\s]+\.[^\s]{2,}$)/)) {
        url.className = "HLerror";
        error.style.visibility="visible";
        if(!document.getElementById("error_url"))
            error.innerHTML += "<p id=\"error_url\">Website URL must be either empty or in a valid URL format and without leading or trailing spaces.</p>";
    }
    else {
        url.className = null;
        if(document.getElementById("error_url"))
            error.removeChild(document.getElementById("error_url"));
        if(error.innerHTML==null || error.innerHTML=="")
            error.style.visibility="hidden";
    }
}