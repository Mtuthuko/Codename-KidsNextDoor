
//to store the id of the element that is being dragged
var id;


/**
 * 
 *Allow dragged item to be pasted in the net div
 */
function allowDrop(ev)
{
    ev.preventDefault();
}

function dragStart(ev)
{
    //store dragged item id
    id = ev.target.id;
}


/**
 * 
 *Allow dragged item to be pasted in the net div
 */
function drop(ev)
{
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    console.log(data);  

    //change color to green
    var card = document.getElementById(data);
    card.style.border =  "3px solid rgba(0, 255, 0, 0.72)";
    card.style.backgroundColor = "rgba(115, 255, 115, 0.72)";
    // = "border:3px solid rgba(0, 255, 0, 0.72)";

    ev.target.appendChild(document.getElementById(data));
}


function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}
