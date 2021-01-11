<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header('location: ../home.html');
    }
    else {
        function displayprofile() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $game_check_query = "SELECT * FROM gamers WHERE gamerid='$gamerid'";
            $res = mysqli_query($mysqli,$game_check_query);

            return $res;
        }

        function displayrecentlyplayed() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $games = "SELECT * FROM xbox WHERE gamerid='$gamerid' ORDER BY updatedate DESC LIMIT 3";
            $res = mysqli_query($mysqli,$games);

            return $res;
        }

        function displaygamescompleted() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $finished = "SELECT * FROM xbox WHERE gamerid='$gamerid' AND completion = 100";
            $res = mysqli_query($mysqli,$finished);

            return $res;
        }

        function displaytopgames() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $top = "SELECT * FROM xbox WHERE gamerid='$gamerid' ORDER BY rating DESC LIMIT 3";
            $res = mysqli_query($mysqli,$top);

            return $res;
        }

        // function displayfriends() {
        //     include('db.php');
        //     $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

        //     $game = "SELECT name FROM xbox WHERE gamerid='$gamerid' ORDER BY updatedate DESC LIMIT 1";
        //     $res = mysqli_query($mysqli,$game);
        //     $gamename = mysqli_fetch_assoc($res);

        //     $games = $gamename['name'];

        //     $users = "SELECT gamerid FROM xbox, gamers WHERE xbox.name='$games' AND gamers.privacy = 'No' LIMIT 3";
        //     $resnew = mysqli_query($mysqli,$users);

        //     return $resnew;
        // }
    }
?>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <header>
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboardxbox.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile" class="active">
                    <a class="active" href="#"> Profile </a>
                </div>
                <div id="newgame">
                    <a href="./newgamexbox.php"> Add Game </a>
                </div>
                <div id="updategame">
                    <a href="./updategamexbox.php"> Update Game </a>
                </div>
                <div id="allgames">
                    <a href="./allgamesxbox.php"> View Games </a>
                </div>
                <div id="logout">
                    <a href="./logout.php" class="logoutref"> Logout </a>
                </div>
            </div>
            <div id="contentarea">
            <h2 id="h2style">ABOUT</h2>
            <br>
            <?php $profile = displayprofile(); 
                  $row = mysqli_fetch_array($profile) 
            ?>
            NAME: <?php echo $row['gamerid']; ?>
            <br> 
            PHONE: <?php echo $row['phnum']; ?>
            <br>
            PLATFORM: <?php echo $row['platform']; ?>
            <br>
            EMAIL: <?php echo $row['email']; ?>
            <br>
            <h2 id="h2style">RECENTLY PLAYED</h2>
            <?php $games = displayrecentlyplayed(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Completion Rate</th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($games)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['completion'] . "%</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <h2 id="h2style">STATS</h2>
            <h3 id="h3style">Games Completed</h3>
            <?php $complete = displaygamescompleted(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Completion Rate</th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($complete)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['completion'] . "%</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <h3 id="h3style">Top Rated Games</h3>
            <?php $toprated = displaytopgames(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Rating</th>
                <th> Completion</th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($toprated)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['rating'] . "</td><td>". $row['completion'] . "%</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <br>
            <br>
            </div>
        </div>
    </body>
</html>