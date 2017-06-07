var content = document.getElementById("content");
var modals = document.getElementsByClassName("modal");

var colors = ['#171A1D', '#1A171D', '#1D1717', '#1D1D17', '#171D17'];
var colorIndex = 1;

/*
  Change body color to next color in colors array
*/
content.onclick = function(e) {
    if(e.target != content)
        return;

    document.body.style.background = colors[colorIndex++];

    //Change color to next color in array
    if(colorIndex == colors.length)
        colorIndex = 0;
}

for(var i = 0; i < modals.length; i++) {
    modals[i].onclick = function(e) {
        if(e.target.className != "modal")
            return;
        closeModal(e.target.id);
    }
}

/***************************************************************/

/*
    Open modal window with the id of modal-[id]
    where [id] is a string parameter to this function
*/
function openModal(id) {
    var modal = document.getElementById(id);
    modal.style.display = "flex";
    setTimeout(function() {
        modal.style.opacity = "1";
    }, 1);
}

/*
    Close modal window with the id of modal-[id]
    where [id] is a string parameter to this function
*/
function closeModal(id) {
    var modal = document.getElementById(id);
    modal.style.opacity = "0";
    setTimeout(function() {
        modal.style.display = "none"
    }, 200);
}
