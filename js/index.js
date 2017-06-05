var content = document.getElementById("content");
var colors = ['#171A1D', '#1A171D', '#1D1717', '#1D1D17', '#171D17'];
var index = 1;

/*
  Change body color to next color in colors array
*/
content.onclick = function(e) {
    if(e.target != content)
        return;

    document.body.style.background = colors[index++];
    if(index == colors.length)
        index = 0;
}

/***************************************************************/

/*
    Open modal window with the id of modal-[id]
    where [id] is a string parameter to this function
*/
function openModal(id) {
    var modal = document.getElementById("modal-" + id);
    modal.style.display = "flex";
    setTimeout(function() {modal.style.opacity = "1";}, 1);
}

/*
    Close modal window with the id of modal-[id]
    where [id] is a string parameter to this function
*/
function closeModal(id) {
    var modal = document.getElementById("modal-" + id);
    modal.style.opacity = "0";
    setTimeout(function() {modal.style.display = "none";}, 200);
}
