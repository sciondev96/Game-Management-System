<?php
    session_start();
    include('db.php');
    if(!isset($_SESSION['username'])) {
        header('location: ../home.html');
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
            
            </div>
        </div>
    </body>
</html>