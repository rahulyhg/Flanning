<?php

if (isset($_POST['userinput'])) {
    session_start();
    $mail = $_POST['userinput'];
    $password = $_POST['passinput'];

    $connection = mysqli_connect('127.0.0.1', '', '', 'my_flanning');

    if (!$connection) {
        die('Errore di connessione: ' . mysqli_connect_error());
    }

    $select_user = "SELECT mail, password FROM User WHERE mail = '$mail' AND password = '$password'";
    $result = mysqli_query($connection, $select_user);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login_user'] = $row["mail"];
        header("Location: index.php");
    }

    mysqli_close($connection);
} else {
    session_start();

    if(session_destroy()) {
        header("Location: login.php");
     }
}


?>