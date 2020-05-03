<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <link rel='stylesheet' type='text/css' media='screen' href='login.css'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>


    <title>Login</title>
</head>

    <body>

        <div class="card">
            <div class="main">

                <div class="logo">
                    <img  style="margin: 5px;"  src ="https://www.wits.ac.za/media/wits-university-style-assets/images/wits-logo.png">

                </div>
                <br><br>
                <form action="" method="post">
                    <div class="form-group" style="align-self:center;display: inline-block;padding: 10px;"  >
                        <label for="uname">Username:</label>
                        <input type="text" id="uname" name="username">
                        <br><br>
                        <label for="password">Password :</label>
                        <input type="text" id="password" name="password">
                        <br><br>
                        <div class="loginButton">
                            <a href="?login">
                                <button name="btn_login">
                                    Login
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</body>
<div>
    <?php 
    //error handling
    if(isset($error)){echo $error;} ?>
            </div>
</html>
