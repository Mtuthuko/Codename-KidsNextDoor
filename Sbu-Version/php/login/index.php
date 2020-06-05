<?php
    

    $username= "";
    $password = "";

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
        //For detecting the button press in login.html.php
        //and giving the user a form to fill in thier joke
        
    }

    function Login($username,$password,$pdo)
    {
        //echo "in the function";
        
        try {
            //code...
            $sql = "SELECT user_password, user_id,user_type from User WHERE username = '$username'";
            $result = $pdo->query($sql);

        } catch (PDOException $e) {

            $error = 'Error loggin in: ' . $e->getMessage();
            echo $error;    
        }

        

        if($row = $result->fetch())
        {
            $passwordFromDB = $row['user_password'] ;

            //echo crypt($password, $passwordFromDB) . "\n";
            
            if($password == $passwordFromDB)
            {
                $response['success'] = '1';
                $response['user_id'] = $row['user_id'];
                $response['user_type'] = $row['user_type'];

                //echo json_encode($response);

                //This where we will redirect the user to their specific dashboard based on their user type
                //User types are ranged as follows
                // 1 = Student , 2 = EGO staff , 3 = Facutly staff

                if($response['user_type'] == '1') //Students
                {
                    header('Location: ../dashboard/students/');
                } 
                else if($response['user_type'] == '2')  //EGO staff
                {
                    header('Location: ../dashboard/admin/ego/home');
                }
                else if($response['user_type'] == '3')  //Faculty staff
                {
                    header('Location: ../dashboard/admin/faculty/home');
                }

                
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
    



    

