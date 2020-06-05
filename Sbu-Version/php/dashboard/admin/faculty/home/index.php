<?php


    //acts as a onClickListener for the navigation bar tab "Venues"
    //'navVenues' found in the home.html.php
    if(isset($_GET['navVenues']))
    {
        header('Location: ../venues');
    }

    //acts as a onClickListener for the navigation bar tab "LogOut"
    //'navLogout' found in the home.html.php
    if(isset($_GET['navLogOut']))
    {
        header('Location: ../../../../login');
    }

    //acts as a onClickListener for the navigation bar tab "createBooking"
    //'createBooking' found in the home.html.php
    if(isset($_GET['createBooking']))
    {
        header('Location: ./bookings/create/');
        exit();
    }

    //Displays the home.html screen(dashboard)
    include 'home.html.php';
    exit;


?>
