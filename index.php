<?php include 'common/dbConn.php';


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
    <title>Vinyls Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include "common/header.php"; ?>

    <div class="index_bacground"></div>

    <div class="index_search_form">
        <form action="search.php" method="GET">
            <input class="index_search_input" type="text" name="searchInput" placeholder="Search for a vinyl..">
            <input class="index_search_btn" type="submit" name="submitSearch" value="Search">
        </form>
    </div>

    <?php include 'components/recently_added.php'; ?>

    <?php include 'common/footer.php'; ?>

    <div class="index_background_2"></div>


    <script src="js/script.js"></script>
</body>

</html>