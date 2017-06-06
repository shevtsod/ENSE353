//  Event Handler registration 
//          

var dom = document.getElementById("id_colourform");

for(var i=0; i < 3; i++) {
	dom.elements[i].addEventListener("click", pick_colour, false);
}


