<?php


if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for Vinyl's</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <?php

    include('common/dbConn.php');

    if (isset($_GET['submitSearch'])) {

        $seachInput = mysqli_real_escape_string($connection, $_GET['searchInput']);

        $query = "SELECT * FROM vinyl WHERE artist LIKE '%$seachInput%' OR vinylName LIKE '%$seachInput%' OR year LIKE '%$seachInput%' OR genre LIKE '$seachInput' OR vinylType LIKE '$seachInput' OR price LIKE '$seachInput'";

        $results = mysqli_query($connection, $query);

    ?>
    <div class='search_container'>
        <?php

            if (mysqli_num_rows($results) == 0 || $seachInput == "") {
                echo "<div class='search_error'><h3>Sorry, no vinyl's were found..</h3></div>";
            } else {

                echo "<h1>Our stock</h1>";

                while ($row = mysqli_fetch_array($results)) {

                    $vinylID = $row['vinylID'];
                    $artist = $row['artist'];
                    $vinylName = $row['vinylName'];
                    $vinylType = $row['vinylType'];

            ?>

        <div class="search_box">
            <div>
                <a href="search_vinyl_detail.php?id=<?= $vinylID ?>"><img src="images/icons/arrow_link.png"
                        alt="link to details arrow"></a>
            </div>
            <div>
                <a href="search_vinyl_detail.php?id=<?= $vinylID ?>">
                    <p>Artist: <?= $artist ?></p>
                    <p><?= $vinylType ?>: <?= $vinylName ?></p>
                </a>
            </div>
        </div>

        <?php
                }
            }
        }
        mysqli_close($connection);
        ?>
    </div>

    <div class="search_background"></div>

    <div class="search_rotating_vinyl">
        <img src="images/search/vinyl_record.png" alt="vinyl record image">
    </div>


    <?php include 'common/footer.php'; ?>

</body>

</html>