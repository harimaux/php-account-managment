<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyls Online - My Acoount</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <p class="login_note">Hi <?php echo $_SESSION['username']; ?>. You are logged in.</p>

    <div class="register_login_background"></div>

    <div class="my_account_container">

        <div class="my_account_add_vinyl">
            <h1>Add Your Vinyl</h1>
            <form action="my_account_add_vinyl.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="artist" placeholder="Artist or band name.." required>
                <input type="text" name="vinylName" placeholder="Album or single name.." required>
                <input type="text" name="year" placeholder="Year of release.." required>
                <input type="text" name="genre" placeholder="Genre.." required>
                <select name="vinylType" required>
                    <option style="background-color: rgb(66, 66, 66)gray" value="Album">Album</option>
                    <option style="background-color: rgb(66, 66, 66)" value="Single">Single</option>
                </select>
                <input type="text" name="price" placeholder="Price.." required>
                <label for="albumCover">
                    <p><br>Add Viny Cover.<br><br>Note: Only .jpg, jpeg, .gif, .webp or .png formats are allowed to max
                        size of 5MB.
                    </p>
                </label>
                <input type="file" name="photo" required>

                <div class="my_account_add_vinyl_btn">
                    <input type="submit" name="addVinyl" value="Add Vinyl">
                </div>
            </form>
        </div>

        <div class="my_account_my_sales_container">
            <h1>My Sales</h1>
            <div class="my_account_my_sales">

                <?php

                include "common/dbConn.php";

                $currentUser = $_SESSION['userID'];
                $admin1 = 1;
                $admin2 = 16;

                if ($currentUser == $admin1 || $currentUser == $admin2) {

                    $userSQL = "SELECT * FROM vinyl ORDER BY dateAdded DESC";
                    $matchedResults = mysqli_query($connection, $userSQL);
                } else {

                    $userSQL = "SELECT * FROM vinyl WHERE userID = '$currentUser' ORDER BY dateAdded DESC";
                    $matchedResults = mysqli_query($connection, $userSQL);
                }

                while ($row = mysqli_fetch_array($matchedResults)) {

                    $artist = $row['artist'];
                    $vinylName = $row['vinylName'];
                    $year = $row['year'];
                    $genre = $row['genre'];
                    $vinylType = $row['vinylType'];
                    $albumCover = $row['albumCover'];
                    $price = $row['price'];
                    $vinylID = $row['vinylID'];

                ?>
                <div class="my_account_my_sales_box">
                    <?php

                        echo "<img src='$albumCover'>";
                        echo "<p>Artist: $artist</p>";
                        echo "<p>$vinylType: $vinylName</p>";
                        echo "<p>Release Year: $year</p>";
                        echo "<p>Genre: $genre</p>";
                        echo "<p>Price: $price</p>";

                        echo "<div class='my_account_edit_delete_btn'>
                    <a href='edit_vinyl.php?id=$vinylID'>Edit</a>
                    <a href='delete_vinyl.php?id=$vinylID'>Delete</a></div>";

                        ?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>