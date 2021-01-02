<?php
    session_start();
    include('./db.php');
?>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <header>
            <img src="../images/homebtn.png" width="70px" height="70px" onclick="location.href='./dashboard.php'"/>
        </header>
        
        <div id="dashboard">
            <div id="navigationbar">
                <div id="profile" class="active">
                    <a class="active" href="#"> Profile </a>
                </div>
                <div id="newgame">
                    <a href="#"> Add Game </a>
                </div>
                <div id="updategame">
                    <a href="#"> Update Game </a>
                </div>
                <div id="allgames">
                    <a href="#"> View Games </a>
                </div>
                <div id="logout">
                    <a href="#"> Logout </a>
                </div>
            </div>
            <div id="contentarea">
            
            </div>
        </div>
    </body>
</html>