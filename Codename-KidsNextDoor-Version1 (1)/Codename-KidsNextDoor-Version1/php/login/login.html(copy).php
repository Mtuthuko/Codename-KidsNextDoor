<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>


    <title>Login</title>
</head>

    <body>

        <div style="background-color:rgba(0, 0, 0, 0.76);" >

            <div class="row" style="align-self: center;" >
                <div class="c-ol-md-4" style="align-self:center; background-color: white">

                    <div style="background-color:rgba(0, 0, 0, 0.25); padding:10px 20px 20px 20px; top:30%; left:25%;right:25%; border-radius: 10px; position:absolute; align-self:center">

                        <div class="logo" style="align-self:center;">
                            <img  style="margin: 5px;"  src ="https://www.wits.ac.za/media/wits-university-style-assets/images/wits-logo.png">

                        </div>
                        <br><br>
                        <form action="" method="post">
                            <div class="form-group" style="align-self:center;display: inline-block;padding: 10px;"  >
                                <label for="uname">Username:</label>
                                <input type="text" id="uname" name="username">
                                <br><br>
                                <label for="password">Password:</label>
                                <input type="text" id="password" name="password">
                                <br><br>
                                <div>
                                    <a href="?login">
                                        <button class="form-group" name="btn_login"style="align-self:center; display: inline-block">
                                            Login
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
