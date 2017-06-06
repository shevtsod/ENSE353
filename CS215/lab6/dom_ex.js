//
// The event handler function to display an alert message 
// depends on the colour you pick

function pick_colour(event) {
    //Get the target node of the event
	var colour = event.currentTarget.value;

   //display an alert message when you pick a colour

    switch (colour) {
        case "red":
	    alert("Roses are red.");
            break;
        case "yellow":
	    alert("lemons are yellow.");
            break; 
        case "blue": 
	    alert("Blue sky is why!");
            break;     
           
        default:
            alert("Error in JavaScript function pick_colour");
            break;
    }
}
