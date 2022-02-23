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

    $vinylID = $row['vinylID'];
    $artist = $row['artist'];
    $vinylName = $row['vinylName'];
    $year = $row['year'];
    $genre = $row['genre'];
    $vinylType = $row['vinylType'];
    $alumCover = $row['albumCover'];
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
    <title>Vinyls Online - Edit Vinyl</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <div class="register_login_background"></div>

    <div class="edit_vinyl_container">

        <div>
            <h1>Edit Vinyl Info</h1>
            <form action="edit_vinyl_fun.php" method="POST" enctype="multipart/form-data">
                <input style="display: none;" type="text" name="vinylID" value="<?php echo $vinylID ?>" readonly>
                <input type="text" name="artist" value="<?php echo $artist ?>">
                <input type="text" name="vinylName" value="<?php echo $vinylName ?>">
                <input type="text" name="year" value="<?php echo $year ?>">
                <input type="text" name="genre" value="<?php echo $genre ?>">
                <select name="vinylType">
                    <option style="background-color: rgb(66, 66, 66)gray" value="Album">Album</option>
                    <option style="background-color: rgb(66, 66, 66)" value="Single">Single</option>
                </select>
                <input type="text" name="price" value="<?php echo $price ?>">
                <label for="albumCover">
                    <p><br>Edit Viny Cover.<br><br>Note: Only .jpg, .jpeg, .gif, .webp or .png formats are allowed to
                        max size
                        of 5MB.
                    </p>
                </label>
                <input type="file" name="photo">
                <div class="edit_vinyl_input_btn">
                    <input type="submit" name="update" value="Update Record">
                </div>
            </form>
        </div>
        <div>
            <img src="<?= $alumCover; ?>" alt="">
        </div>

    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>