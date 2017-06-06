/** Functions **/

//Validate text input
//formname = Name of the form
//tname = Name of the text input
//maxinput = Maximum number of characters allowed for text input
function ValidateForm() {
	var warn = "ERRORS FOUND:\n\n";
	var input = "All input is correct. See your input below:\n\n";
	var errorFound = false;
	
	var firstname = document.forms.form1.firstname.value;
	var lastname = document.forms.form1.lastname.value;
	var gender = document.forms.form1.gender;
	var genval = "";
	var country = document.forms.form1.country;
	var s_index = country.selectedIndex;
	var country_sel = country.options[s_index].value;
	var address = document.forms.form1.address.value;
	var mh = document.forms.form1.mh;
	var medconfirm = document.forms.form1.medconfirm;
	var medc_val;
	var currmed = document.forms.form1.currmed.value;
	
	//First Name
	if(firstname=="" || firstname.length > 50) {
		warn+="* First name cannot be empty or exceed 50 characters.\n";
		errorFound = true;
	}
	//Last Name
	if(lastname=="" || lastname.length > 50) {
		warn+="* Last name cannot be empty or exceed 50 characters.\n";
		errorFound = true;
	}
	//Gender Radio Buttons
	for (var i=0; i < gender.length;i++){
	    if (gender[i].checked){
	      gen_val=gender[i].value;
	      break;
	    }
	  }
	if(i>=gender.length) {
	    warn +="* Gender must be selected.\n";
	    errorFound = true;
	}
	//Country Drop Down List
	if(s_index == 0) {
		warn +="* Country must be selected.\n";
		errorFound = true;
	}
	//Address
	if(address=="" || address > 300) {
		warn+="* Address cannot be empty or exceed 300 characters.\n";
		errorFound = true;
	}
	//Medical History Checkboxes
	for(var i=0; i < mh.length; i++) {
		if(mh[i].checked) {
			break;
		}
	}
	if(i>=mh.length) {
		warn+="* At least one option in Medical History must be selected.\n";
		errorFound = true;
	}
	//Current Medication Radio Buttons
	for (var i=0; i < medconfirm.length;i++){
	    if (medconfirm[i].checked){
	      medc_val=medconfirm[i].value;
	      break;
	    }
	  }
	  if(i>=medconfirm.length) {
	    warn +="* Yes or No must be selected in Current Medication section.\n";
	    errorFound = true;
	}
	//Current Medication Text Area
	//Yes = text area must not be empty
	//No = text area must be empty
	if(medc_val=="yes" && currmed =='') {
		warn +="* If you selected yes, you must fill in the current medication text box.";
		errorFound = true;
	}
	else if(medc_val=="no" && currmed !='') {
		warn +="* If you selected no, you must not fill in the current medication text box.";
		errorFound = true;
	}
	
	/* If not all inputs are correct, show the list of errors. */
	if(errorFound) {
		alert(warn);
		return false;
	}
	
	/*If all inputs are correct, show the user inputs and return true. */
	else {
		input += "* First name: " + firstname + "\n";
		input += "* Last name: " + lastname + "\n";
		input += "* Gender: " + gen_val + "\n";
		input += "* Country: " + country_sel + "\n";
		input += "* Address: " + address + "\n";
		input += "* Medical History: ";
		for(var i=0; i < mh.length; i++) {
			if(mh[i].checked) {
				input += mh[i].value + " ";
			}
		}
		input += "\n";
		input += "* Current Medication: " + medc_val + "\n";
		if(medc_val == "yes")
			input += "* Current Medication Text: " + currmed + "\n";
		
		
		alert(input);
		return true;
	}
}
