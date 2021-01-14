<?php
    session_start();
    include('db.php');
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

            $games = "SELECT * FROM ps WHERE gamerid='$gamerid' ORDER BY updatedate DESC LIMIT 3";
            $res = mysqli_query($mysqli,$games);

            return $res;
        }

        function displaygamescompleted() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $finished = "SELECT * FROM ps WHERE gamerid='$gamerid' AND platinum = 'YES'";
            $res = mysqli_query($mysqli,$finished);

            return $res;
        }

        function displaytopgames() {
            include('db.php');
            $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

            $top = "SELECT * FROM ps WHERE gamerid='$gamerid' ORDER BY rating DESC LIMIT 3";
            $res = mysqli_query($mysqli,$top);

            return $res;
        }
    }
?>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <header>
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboardps.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile" class="active">
                    <a class="active" href="#"> Profile </a>
                </div>
                <div id="newgame">
                    <a href="./newgameps.php"> Add Game </a>
                </div>
                <div id="updategame">
                    <a href="./updategameps.php"> Update Game </a>
                </div>
                <div id="allgames">
                    <a href="./allgamesps.php"> View Games </a>
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
            <span id="det">
                <label id="details">GamerID:&nbsp;</label>&emsp;<?php echo $row['gamerid']; ?>
                <br> 
                <label id="details">Phone:&nbsp;</label>&emsp;<?php echo $row['phnum']; ?>
                <br>
                <label id="details">Platform:&nbsp;</label>&emsp;<?php echo "PlayStation"; ?>
                <br>
                <label id="details">Email:&nbsp;</label>&emsp;<?php echo $row['email']; ?>
                <br>
            </span>
            <h2 id="h2style">RECENTLY PLAYED</h2>
            <?php $games = displayrecentlyplayed(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Trophies Earned</th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($games)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['total'] . "/50</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <h2 id="h2style">STATS</h2>
            <h3 id="h3style">Games Completed</h3>
            <?php $complete = displaygamescompleted(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Platinum</th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($complete)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['platinum'] . "</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <h3 id="h3style">Top Rated Games</h3>
            <?php $toprated = displaytopgames(); ?>
            <table id="displaytable">
                <th> Game </th>
                <th> Rating</th>
                <th> Bronze</th>
                <th> Silver</th>
                <th> Gold </th>
                <th> Platinum </th>
                <th> Last Played</th>
                <?php
                    while($row = mysqli_fetch_array($toprated)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['rating'] . "</td><td>". $row['bronze'] . "/35</td><td>". $row['silver'] . "/12</td><td>". $row['gold'] . "/3</td><td>". $row['platinum'] . "</td><td>". $row['updatedate'] . "</td></tr>";  
                    }
                ?>
            </table>
            <br>
            <br>
            </div>
        </div>
    </body>
</html>