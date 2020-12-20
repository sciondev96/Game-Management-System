<?php
    session_start();
    include('db.php');
    $ph = "";

    if($_POST['submit']) {
        $ph = mysqli_real_escape_string($mysqli, $_POST['phno']);    
    }

    $user_check_query = "SELECT * FROM gamers WHERE phnum='$ph' LIMIT 1";
    $result = mysqli_query($mysqli, $user_check_query);
    if (mysqli_num_rows($result) == 0) {
        echo '<script>
                alert("The number enter does not exist. Please enter correct number.")
              </script>';
        echo '<script>
                window.location.href="../forgot.html"
              </script>';
    }
    else {
        $_SESSION['regno'] = $ph;
        header('location: ../updatepw.html');
    }

?>