<?php
    session_start();
    include('db.php');

    $pass = "";

    if($_POST['submit']) {
        $pass = mysqli_real_escape_string($mysqli, $_POST['pass1']);    
    }
    $regno = $_SESSION['regno'];
    $sql = "UPDATE gamers SET password='$pass' WHERE phnum='$regno'";
    if($mysqli->query($sql)) {
        header('location: ../home.html');
    }

?>