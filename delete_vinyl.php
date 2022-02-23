<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    exit(header('location:login.php'));
}

include "common/dbConn.php";

//GET ID FROM URL

$id = (isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : "");

$getIdSQL = "SELECT * FROM vinyl WHERE vinylID = '$id'";

$IDresults = mysqli_query($connection, $getIdSQL);

while ($row = mysqli_fetch_array($IDresults)) {

    $artist = $row['artist'];
    $vinylName = $row['vinylName'];
    $year = $row['year'];
    $genre = $row['genre'];
    $vinylType = $row['vinylType'];
    $albumCover = $row['albumCover'];
    $price = $row['price'];
    $userID = $row['userID'];
}

$currentUser = $_SESSION['userID'];
$admin1 = 1;

if ($currentUser != $admin1) {
    if ($currentUser != $userID) {
        exit(header("location:my_account.php"));
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyls Online - Delete Vinyl</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <div class="register_login_background"></div>

    <div class="delete_container">

        <div>
            <h1>Delete Vinyl</h1>
            <p>Artist: <?= $artist ?></p>
            <p><?= $vinylType ?>: <?= $vinylName ?></p>
            <p>Release Year: <?= $year ?></p>
            <p>Genre: <?= $genre ?></p>
            <p>Price: <?= $price ?></p>
            <div class="delete_btn">
                <form action="delete_vinyl_script.php" method="POST">
                    <input type="hidden" name="vinylID" value="<?php echo $id ?>" readonly>
                    <input type="submit" name="deleteBtn" value="Delete">
                </form>
            </div>
        </div>
        <div>
            <img src="<?= $albumCover ?>" alt="<?= $vinylName ?>">
        </div>

    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>