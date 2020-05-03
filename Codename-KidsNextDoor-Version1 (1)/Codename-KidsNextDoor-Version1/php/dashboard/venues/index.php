<?php

    require '../../connect.php';

    if(isset($_GET['navLogOut']))
    {
        header('Location: ../../login');
    }

    try {
        //code...
        $sql = "SELECT venue_name,venue_capacity from Venue";
        $result = $pdo->query($sql);

    } catch (PDOException $e) {

        $error = 'Server error ' . $e->getMessage();
        echo $error;    
    }

    //Saving the values from the table, specific to the row
    while ($row = $result->fetch())
    {
        $venue_names[] = $row['venue_name'];
        $venue_capacities[] =$row['venue_capacity'];
    }

    include 'venues.html.php';

?>