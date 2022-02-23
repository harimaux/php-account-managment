<?php


if (!isset($_SESSION)) {
    session_start();
}

?>

<?php
include "common/dbConn.php";

$id = (isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : "");


$query = "SELECT * FROM vinyl WHERE vinylID = '$id'";

$results = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($results)) {

    $artist = $row['artist'];
    $vinylName = $row['vinylName'];
    $year = $row['year'];
    $genre = $row['genre'];
    $vinylType = $row['vinylType'];
    $albumCover = $row['albumCover'];
    $price = $row['price'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyl Search Detail</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>?

    <div class="search_detail_container">
        <div class="search_detail_arrow_back"><img src="images/icons/arrow_link.png" alt="go back to homepage arrow"
                onclick="history.back()"></div>
        <div class=" search_detail_box">
            <img src="<?= $albumCover ?>" alt="<?= $artist ?> vinyl cover image">
            <h1>Artist: <?= $artist ?></h1>
            <h2><?= $vinylType ?>: <?= $vinylName ?></h2>
            <p>Genre: <?= $genre ?></p>
            <p>Year of Release: <?= $year ?></p>
            <p>Price: £<?= $price ?></p>
        </div>
    </div>

    <div class="search_background"></div>

    <div class="search_detail_rotating_vinyl">
        <img src="images/search/vinyl_record.png" alt="vinyl record image">
    </div>

    <?php include 'common/footer.php'; ?>?

    <?php mysqli_close($connection); ?>

</body>

</html>