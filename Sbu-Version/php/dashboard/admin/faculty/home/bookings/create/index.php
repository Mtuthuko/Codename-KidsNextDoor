<?php

require '../../../../../../connect.php';


//View available venues
function getAvailableVenues()
{
    require '../../../../../../connect.php'; 
}

function searchCourses(string $code)
{
    require '../../../../../../connect.php'; 

    //get a list of all the course codes
    try 
    {
        $sql = "SELECT course_code ,ID from Courses";
        $result = $pdo->query($sql);
          
    } catch (PDOException $e) {
        //////we need to do something
    } 

    

}

//Retrieve venues from database
try {
    $sql = "SELECT venue_id,venue_name,venue_availability from Venue";
    $result = $pdo->query($sql);

} catch (PDOException $e) {

    $error = 'Server error ' . $e->getMessage();
    echo $error;    
} 

$venues = array();
//Saving the values from the table, specific to the row
while ($row = $result->fetch())
{
    /*
    if($row['venue_availability'] > 0)
    {
        $venues[] = array(
            'id' => row['venue_id'],
            'name' => row['venue_name']);
    }
    else{

    }   
    */

    $venue['name'] = $row['venue_name'];
    $venue['id'] =$row['venue_id'];
    $venue['availibility'] =$row['venue_availability'];   
    
    array_push($venues,$venue);
}


include('form.html.php');
exit();

?>