<?php
    include('db.php');

    $name = "";
    $id = "";
    $email = "";
    $pass = "";
    $ph = "";
    $privacy = "";
    $platform = "PS";

    $errors = array(); 

    if($_POST['submit']) {
        $name = mysqli_real_escape_string($mysqli, $_POST['psname']);
        $id = mysqli_real_escape_string($mysqli, $_POST['psgamerid']);
        $email = mysqli_real_escape_string($mysqli, $_POST['psemail']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['pspass']);
        $ph = mysqli_real_escape_string($mysqli, $_POST['psph']);
        $privacy = mysqli_real_escape_string($mysqli,$_POST['pschoice']);
    
    }

    $user_check_query = "SELECT * FROM gamers WHERE gamerid='$id' LIMIT 1";
    $result = mysqli_query($mysqli, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { // if user exists
        if ($user['gamerid'] === $id) {
          array_push($errors, "Username already exists. Please choose a new one.");
        }
    }
    if(count($errors) == 0) {
        $query = "INSERT INTO gamers (gamerid, name, email, password, phnum, privacy,platform) VALUES ('$id', '$name', '$email', '$pass', '$ph', '$privacy','$platform')"; 
        mysqli_query($mysqli, $query);
        header('location: ../pslogin.html');
    }
    else {
        echo "<script>alert('Username already exists.');</script>";
        echo "<script>window.location.href='../psregister.html';</script>";
    }
?>