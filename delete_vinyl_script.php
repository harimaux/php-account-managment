<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    exit(header('location:login.php'));
}

include "common/dbConn.php";

if (isset($_POST['deleteBtn'])) {

    $id = $_POST['vinylID'];

    $deleteSql = "DELETE FROM vinyl WHERE vinylID = '$id' LIMIT 1";
    $deleteResults = mysqli_query($connection, $deleteSql);

    exit(header("location:my_account.php"));
}