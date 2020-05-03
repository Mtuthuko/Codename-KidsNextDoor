<?php
    
    //This file is the login controller 



    $username= "";
    $password = "";


    //Connect to server 
    require '../connect.php';

    //Retriving the username and password
    if(!isset($_REQUEST['username']) || !isset($_REQUEST['password']))
    {
        include 'login.html.php';
        exit();
    }
    else{

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        
        Login($username,$password,$pdo);
    }


    //Function to log the user in
    function Login($username,$password,$pdo)
    {
        //echo "in the function";
        
        //Retrieving user name and password from database
        try {
            $sql = "SELECT user_password, user_id from User WHERE username = '$username'";
            $result = $pdo->query($sql);

        } catch (PDOException $e) {

            $error = 'Error loggin in: ' . $e->getMessage();
            echo $error;    
        }

        
        //This if statement checks if the sql result has any rows in it
        if($row = $result->fetch())
        {
            $passwordFromDB = $row['user_password'] ;

            //Comparing the passwords
            if($password == $passwordFromDB)
            {
                //Will be used later for sessions
                $response['success'] = '1';
                $response['user_id'] = $row['user_id'];
                echo json_encode($response);

                //navigation to the dashboard
                header('Location: ../dashboard/home');
                exit();
            }
            else
            {
                $error = "Incorrect username/password";
                include 'login.html.php';
            }
        }
        else
        {
            $error = "Incorrect username/password";
            include 'login.html.php';
        }     
    }
    



    

