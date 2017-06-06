/** Functions **/
function validateForm() {
	var correct = true;
	
	var u_id = document.getElementById("u_id").value;
	var u_first = document.getElementById("u_first").value;
	var u_last = document.getElementById("u_last").value;
	
	var id_msg = document.getElementById("id_msg");
	var first_msg = document.getElementById("first_msg");
	var last_msg = document.getElementById("last_msg");
	
	var display_info = document.getElementById("display_info");
	
	var warn = "You forgot to fill in the following field(s): ";
	
	var display_id = document.createElement('p');
	var display_first = document.createElement('p');
	var display_last = document.createElement('p');
	
	//Clear display_info's children
	while (display_info.hasChildNodes()) {
	    display_info.removeChild(display_info.lastChild);
	}

	
	//Initialize three empty nodes for display info.
	display_info.appendChild(display_id);
	display_info.appendChild(display_first);
	display_info.appendChild(display_last);
	
	//Check ID
	if(u_id == null || u_id == "") {
		warn += "ID" + ", ";
		id_msg.innerHTML = "Please Enter an ID";
		correct = false;
	}
	else {
		id_msg.innerHTML = "";
	}
	
	//Check First Name
	if(u_first == null || u_first == "") {
		warn += "First Name" + ", ";
		first_msg.innerHTML = "Please Enter a First Name";
		correct = false;
	}
	else {
		first_msg.innerHTML = "";
	}
	
	//Check Last Name
	if(u_last == null || u_last == "") {
		warn += "Last Name" + ", ";
		last_msg.innerHTML = "Please Enter a Last Name";
		correct = false;
	}
	else {
		last_msg.innerHTML = "";
	}
	
	//If incorrect, display error alert, otherwise display the input below.
	if(!correct) {
		//Remove trailing ", "
		warn = warn.substring(0, warn.length -2);
		alert(warn);
	}
	else {
		display_id.innerHTML = "User ID: " + u_id;
		display_first.innerHTML = "First Name: " + u_first;
		display_last.innerHTML = "Last Name: " + u_last;
		document.getElementById("u_id").value = '';
		document.getElementById("u_first").value = '';
		document.getElementById("u_last").value = '';
	}
	
}

/***************/
