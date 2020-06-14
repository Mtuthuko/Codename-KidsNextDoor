//to store the user's id
var user_id;

//to store the id of the element that is being dragged
var id;


/**
 * 
 *Allow dragged item to be pasted in the net div
 */
function allowDrop(ev)
{
    console.log(ev.target);
    ev.preventDefault();
}

function dragStart(ev)
{
    //store dragged item id
    id = ev.target.id;
}


/**
 * 
 *Allow dragged item to be pasted into the next div
 */
function drop(ev)
{
    ev.preventDefault();

    var data = ev.dataTransfer.getData("div");
   
    console.log("When I drop its: "+ev.target.id + " and data: " + data);
    
    //The target div
    target = ev.target.id; 

    var card = document.getElementById(data);

    if( target == "resolved")
    {
        //change color to green
        
        card.style.border =  "2px solid rgba(0, 255, 0, 0.72)";
        card.style.backgroundColor = "rgba(115, 255, 115, 0.5)";
    
        //
        clash_id =  document.getElementById('clash_id');

        //get the div where we want to drop the clash
        var resolved = document.getElementById('resolved');
        console.log(ev.target);  
        //places the dragged item into resolved div
        resolved.appendChild(document.getElementById(data));
    }
    else if(target == "unresolved")
    {
        //change color to red
        
        card.style.border =  "2px solid rgba(226, 15, 15, 0.72)";
        card.style.backgroundColor = "wheat";
    
        //
        clash_id =  document.getElementById('clash_id');

        //get the div where we want to drop the clash
        var unresolved = document.getElementById('unresolved');
        console.log(ev.target);  
        //places the dragged item into resolved div
        unresolved.appendChild(document.getElementById(data));
    }
    else
    {
        //change color to green
        
        card.style.border =  "2px solid rgba(0, 255, 0, 0.72)";
        card.style.backgroundColor = "rgba(115, 255, 115, 0.5)";
    
        //
        clash_id =  document.getElementById('clash_id');

        //get the div where we want to drop the clash
        var resolved = document.getElementById('resolved');
        console.log(ev.target);  
        //places the dragged item into resolved div
        resolved.appendChild(document.getElementById(data));
    }

    
}

function update(clash_id)
{
    if(clash_id.textContent != "0")
    {
        var updateURL = '/home/update?id='+clash_id.textContent;

        console.log(clash_id.textContent);
        document.location.href= updateURL;
       
    }
}


function drag(ev) {
    ev.dataTransfer.setData("div", ev.target.id);
}
