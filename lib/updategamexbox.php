<?php
    session_start();

    function updatedata() {
        
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
        $updatescore = $score+$game['gamerscore'];
        if($game) {
            if ($game['name'] === $name) {
                if ($updatescore > 1000) {
                    array_push($errors, "Gamerscore exceeds limit.");
                }
            }
        }
        else {
            array_push($errors, "Game does not exist.");
        }

        if(count($errors) == 0) {
            $completion = ($updatescore/1000)*100;
            $query = "UPDATE xbox SET gamerscore = '$updatescore', rating = '$rating', completion='$completion', updatedate='$date' WHERE gamerid = '$gamerid' and name = '$name'";
            mysqli_query($mysqli,$query);
            header('location: ./dashboardxbox.php');
        }
        else {
            echo "<script>alert('Gamescore exceeds limit of 1000 OR Game does not exist.');
                  window.location.href='./updategamexbox.php';
                  </script>";
        }

    }
    if(!isset($_SESSION['username'])) {
        header('location: ../home.html');
    }
    else {
        if(isset($_POST['submit'])) {
            updatedata();
        }
    }
?>

<html>
    <head>
        <title>Update Game Score</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <header>
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboardxbox.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile">
                    <a href="./dashboardxbox.php"> Profile </a>
                </div>
                <div id="newgame">
                    <a href="./newgamexbox.php" class="active"> Add Game </a>
                </div>
                <div id="updategame" class="active">
                    <a href="#" class="active"> Update Game </a>
                </div>
                <div id="allgames">
                    <a href="./allgamesxbox.php"> View Games </a>
                </div>
                <div id="logout">
                    <a href="./logout.php" class="logoutref"> Logout </a>
                </div>
            </div>
            <div id="contentarea">
                <form method="POST" action="updategamexbox.php">
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
                        <input type="submit" name="submit" value="Update" id="submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </body>
</html>