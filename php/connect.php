<?php
    //For the connection to the database
    try
    {
        $pdo = new PDO('mysql:host =https://remotemysql.com/; dbname=Wex', 'WexUser',
        '!wexAdmin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
        //echo "connection successful: ";
    }
    catch (PDOException $e)
    {
        //If failed to connect to server, send the user to the error screen
        $error = 'Unable to connect to the database server.';
        include 'error.html.php';
        exit();
    }
?>
