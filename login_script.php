<?php

include('common/dbConn.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $inputEmail = mysqli_real_escape_string($connection, $_POST['email']);
    $inputPassword = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$inputEmail'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($results);

    $dbPassword = $row['password'];

    if (password_verify($inputPassword, $dbPassword)) {

        $_SESSION['username'] = $row['firstName'];
        $_SESSION['userID'] = $row['userID'];
        header('location:my_account.php');
    } else {

        setcookie('cssVar', 'true', time() + 1);
        header('location:login.php');
    }
}

mysqli_close($connection);