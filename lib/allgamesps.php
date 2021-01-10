<?php
    session_start();

    function displaydata() {

        include('db.php');
        $gamerid = mysqli_real_escape_string($mysqli,$_SESSION['username']);

        $game_check_query = "SELECT * FROM ps WHERE gamerid='$gamerid'";
        $res = mysqli_query($mysqli,$game_check_query);

        return $res;
    }
?>

<html>
    <head>
        <title>All Games</title>
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
                <div id="newgame">
                    <a href="./newgameps.php" class="active"> Add Game </a>
                </div>
                <div id="updategame">
                    <a href="./updategameps.php"> Update Game </a>
                </div>
                <div id="allgames" class="active">
                    <a href="#" class="active"> View Games </a>
                </div>
                <div id="logout">
                    <a href="./logout.php" class="logoutref"> Logout </a>
                </div>
            </div>
            <div id="contentarea">
                <?php
                    if(!isset($_SESSION['username'])) {
                        header('location: ../home.html');
                    }
                    else {
                            $res = displaydata();
                    }
                ?>
                <label id="idlabel"> 
                    <?php
                        echo $_SESSION['username'];
                    ?> 
                </label>
                
                <table id="displaytable">
                    <th> Game </th>
                    <th> Rating </th>
                    <th> Bronze </th>
                    <th> Silver </th>
                    <th> Gold </th>
                    <th> Total </th>
                    <th> Platinum </th>
                    <th> Updated On </th>
                    <?php
                        while($row = mysqli_fetch_array($res)) {
                            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['rating'] . "</td><td>". $row['bronze'] . "</td><td>"
                            . $row['silver'] . "</td><td>". $row['gold'] . "</td><td>". $row['total'] . "</td><td>".
                            $row['platinum'] . "</td><td>". $row['updatedate'] . "</td></tr>";  
                        }
                    ?>
                </table>

            </div>
        </div>
    </body>
</html>