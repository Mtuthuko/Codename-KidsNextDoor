<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel='stylesheet' type='text/css' media='screen' href='venue.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Venues</title>


    </head>

    <header>
        <nav>
            <h1>Wex</h1>
            <ul>
                <li><a href="#">Course</a></li>
                <li><a href="?navVenues" name="navVenues">Venues</a></li>
                <li><a href="?navLogOut">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <body>
        <h1 class="text-center">This where the Venues are going to go</h1>
        <div>
            <?php
            foreach ($venue_names as $venue_name) :?>
            <br>
            <?php echo htmlspecialchars($venue_name, ENT_QUOTES, 'UTF-8'); ?>
            <br>
            <?php endforeach; ?>
        </div>
    </body>
</html>
