<?php
    session_start();

    function insertdata() {
        
        $errors = array();

        include('db.php');
        $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);
        $name = mysqli_real_escape_string($mysqli,$_POST['gname']);
        $score = (int)mysqli_real_escape_string($mysqli,$_POST['score']);
        $rating = (int)mysqli_real_escape_string($mysqli,$_POST['rating']);
        $date = date('Y-m-d H:i:s');
        $completion = ($score/1000)*100;

        $game_check_query = "SELECT * FROM xbox WHERE name='$name' LIMIT 1";
        $res = mysqli_query($mysqli,$game_check_query);
        $game = mysqli_fetch_assoc($res);
        if($game) {
            if ($game['name'] === $name) {
                array_push($errors, "Game already exists");
            }
        }

        if(count($errors) == 0) {
            $query = "INSERT INTO xbox (gamerid, name, gamerscore, completion, updatedate, rating) VALUES ('$gamerid','$name',$score,$completion , '$date', $rating)";
            mysqli_query($mysqli,$query);
            header('location: ./dashboard.php');
        }
        else {
            echo "<script>alert('Game already exists. Try updating game facts.');
                  window.location.href='./newgame.php';
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
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboard.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile">
                    <a href="./dashboard.php"> Profile </a>
                </div>
                <div id="newgame" class="active">
                    <a href="#" class="active"> Add Game </a>
                </div>
                <div id="updategame">
                    <a href="./updategame.php"> Update Game </a>
                </div>
                <div id="allgames">
                    <a href="./allgames.php"> View Games </a>
                </div>
                <div id="logout">
                    <a href="#"> Logout </a>
                </div>
            </div>
            <div id="contentarea">
                <form method="POST" action="newgame.php">
                    <div>
                        Game:
                        <br>
                        <input type="text" required autofocus name="gname"/>
                    </div>
                    <br>
                    <div>
                        Gamerscore:
                        <br>
                        <input type="number" required name="score" min="5" max="1000"  id="sc"/>
                    </div>
                    <br>
                    <span id='message'></span>
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