<?php


    //acts as a onClickListener for the navigation bar tabe "Venues"
    //'navVenues' found in the home.html.php
    if(isset($_GET['navVenues']))
    {
        header('Location: ../venues');
    }

    //acts as a onClickListener for the navigation bar tabe "LogOut"
    //'navLogout' found in the home.html.php
    if(isset($_GET['navLogOut']))
    {
        header('Location: ../../login');
    }

    include 'home.html.php';
    exit;


?>
