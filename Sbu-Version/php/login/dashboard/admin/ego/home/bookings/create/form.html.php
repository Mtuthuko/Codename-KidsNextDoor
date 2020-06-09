<!DOCTYPE html>
<html>


    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <link rel='stylesheet' type='text/css' media='screen' href='form.css'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
    </head>


    <title>Create Booking</title>

    <body>
    
        <header>
            <!--The block code is the banner-->
        <div class="banner"> 
                <nav>
                <img src="wits-logo.png" alt="wits-logo">
                
                </nav>
        </div>
        </header>
        <body>
            <form action="">
                <div class="dash_body">
                    <label >Exam Title</label>
                    <div style="margin-left: 30em;" class="text"> <input type="text" name="Exam Title"></div>
                </div>

                <div class="dash_body">
                    <label >Add Courses</label>
                   <div style="margin-left: 29.1em;" class="text"> <input type="text" name="Add Courses"></div>
                </div>

                <div class="description">
                    <label >Exam Discription</label>
                    <div style="margin-left: 27em;" class="text"><textarea maxlength="250" wrap="hard" name="Exam discription" id="discription" cols="30" rows="5"></textarea></div>
                </div>
                 
                <div class="dash_body">
                    <label >Duration</label>
                    <div style="margin-left: 30.5em;" class="text">
                        <select  name="Duartion" id="">
                            <option  value="" ></option>
                            <option value="30 min">30 min</option>
                            <option value="1">1 Hour</option>
                            <option value="1 H 30 min ">1 H 30 min</option>
                        </select>
                    </div>
                </div>
                 
                <div class="dash_body">
                    <label >Venue Request</label>
                   <div style="margin-left: 28em;" class="text"> <input type="text" name="venue request"></div>
                </div>

                <div class="dash_body">
                    <label >Paper</label>
                    <div style="margin-left: 31.6em;" class="text">
                        <select  name="Paper" id="">
                            <option  value="0" ></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="special"><h1>Speacial Request</h1></div>

                <div class="dash_body">
                    <label >Time</label>
                  <div class="timing">   <div class="text"><input type="time" name="startTime"> </div> to <div class="text"> <input type="time" name="endTwime"></div></div>
                </div>

                <div class="dash_body">
                    <label >AM/PM</label>
                    <div style="margin-left: 30.5em;" class="text">
                        <select  name="AM/PM" id="">
                            <option  value="" ></option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                            
                        </select>
                    </div>
                </div>

                <div class="dash_body">
                    <label >Venue</label>
                   <div style="margin-left: 31.4em;" class="text"> <input type="text" name="venue "></div>
                </div>

                <div class="dash_body">
                    <label >Type Of Table</label>
                    <div style="margin-left: 28em;" class="text">
                        <select  name="typeOfTable" id="">
                            <option  value="" ></option>
                            <option value="Single Desk">Single Desk</option>
                            <option value="Double Desk">Double Desk</option>
                            <option value="Drawing Desk">Drawing Desk</option>
                        </select>
                    </div>
                </div>
                <div class="formButtons">
                    <div style="display:inline;margin-right: 10%" >
                        <a href="?submit">
                            <button name="btn_submit">
                                Submit
                            </button>
                        </a>    
                    </div>
                    <div style="display:inline;margin-left: 10%">
                        <a href="cancel">
                            <button name="btn_submit">
                                Cancel
                            </button>
                        </a>    
                    </div>
                </div>
            </form>
                
            

        </body>

        
        <script src='main.js'></script>
    
    </body>

 <footer> ©2020 Wex</footer>
</html>