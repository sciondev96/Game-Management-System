<?php
    session_start();
    include('db.php');

    $id = "";
    $pass = "";

    if($_POST['submit']) {
        $id = mysqli_real_escape_string($mysqli, $_POST['gamerid']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['pass']);    
    }

    $login_query = "SELECT * FROM gamers WHERE gamerid='$id' AND password='$pass'";
    $result = mysqli_query($mysqli, $login_query);
    if(mysqli_num_rows($result) == 0) {
        echo "<script>alert('Incorrect ID/Password.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else {
        $res = mysqli_fetch_assoc($result);
        $platform = $res['platform'];
        if($platform === "Xbox") {
            $_SESSION['platform'] = $platform;
            $_SESSION['username'] = $id;
            header("location: ./dashboardxbox.php");
        }
        else {
            $_SESSION['platform'] = $platform;
            $_SESSION['username'] = $id;
            header("location: ./dashboardps.php");
        }
        
    }
?>