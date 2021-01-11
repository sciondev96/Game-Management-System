<?php
    session_start();

    function insertdata() {
        
        $errors = array();

        include('db.php');
        $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);
        $name = mysqli_real_escape_string($mysqli,$_POST['gname']);
        $bt = (int)mysqli_real_escape_string($mysqli,$_POST['bt']);
        $st = (int)mysqli_real_escape_string($mysqli,$_POST['st']);
        $gt = (int)mysqli_real_escape_string($mysqli,$_POST['gt']);
        $rating = (int)mysqli_real_escape_string($mysqli,$_POST['rating']);
        $date = date('Y-m-d H:i:s');
        $total = $bt+$st+$gt;
        if($total == 50) {
            $platinum = "YES";
        }
        else {
            $platinum = "NO";
        }

        $game_check_query = "SELECT * FROM ps WHERE name='$name' LIMIT 1";
        $res = mysqli_query($mysqli,$game_check_query);
        $game = mysqli_fetch_assoc($res);
        if($game) {
            if ($game['name'] === $name and $game['gamerid'] === $gamerid) {
                array_push($errors, "Game already exists");
            }
        }

        if(count($errors) == 0) {
            $query = "INSERT INTO ps (gamerid, name, bronze, silver, gold, total, platinum, updatedate, rating) VALUES ('$gamerid','$name', $bt, $st, $gt, $total, '$platinum' , '$date', $rating)";
            mysqli_query($mysqli,$query);
            header('location: ./dashboardps.php');
        }
        else {
            echo "<script>alert('Game already exists. Try updating game facts.');
                  window.location.href='./newgameps.php';
                  </script>";
        }

    }
    if(!isset($_SESSION['username'])) {
        header('location: ../home.html');
    }
    else {
        if(isset($_POST['submit'])) {
            insertdata();
        }
    }
?>

<html>
    <head>
        <title>Add New Game</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <header>
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboardps.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile">
                    <a href="./dashboardps.php"> Profile </a>
                </div>
                <div id="newgame" class="active">
                    <a href="#" class="active"> Add Game </a>
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
                <form method="POST" action="newgameps.php">
                    <div>
                        Game:
                        <br>
                        <input type="text" required autofocus name="gname"/>
                    </div>
                    <br>
                    <div>
                        Bronze Trophies:
                        <br>
                        <input type="number" required name="bt" min="0" max="35"  id="bt"/>
                    </div>
                    <br>
                    <div>
                        Silver Trophies:
                        <br>
                        <input type="number" required name="st" min="0" max="12"  id="st"/>
                    </div>
                    <br>
                    <div>
                        Gold Trophies:
                        <br>
                        <input type="number" required name="gt" min="0" max="3"  id="gt"/>
                    </div>
                    <br>
                    <div>
                        Rating:
                        <br>
                        <input type="number" required name="rating" min="1" max="10" id="rt"/>
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="submit" value="Insert" id="submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </body>
</html>