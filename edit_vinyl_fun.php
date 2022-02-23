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
    <title>Vinyls Online - Edit Vinyl</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <div class="register_login_background"></div>

    <div class='edit_vinyl_script'>

        <?php

        include "common/dbConn.php";

        $errorLinkToAccount = "<a href='my_account.php'>&nbsp; - back to my account.</a>";

        if (isset($_POST['update'])) {

            $vinylID = mysqli_real_escape_string($connection, $_POST['vinylID']);
            $artist = mysqli_real_escape_string($connection, $_POST['artist']);
            $vinylName = mysqli_real_escape_string($connection, $_POST['vinylName']);
            $year = mysqli_real_escape_string($connection, $_POST['year']);
            $genre = mysqli_real_escape_string($connection, $_POST['genre']);
            $vinylType = mysqli_real_escape_string($connection, $_POST['vinylType']);
            $price = mysqli_real_escape_string($connection, $_POST['price']);

            $sql = "UPDATE vinyl SET artist = '$artist',
            vinylName = '$vinylName',
            year ='$year', genre = '$genre',
            vinylType = '$vinylType',
            price = '$price' WHERE vinylID = '$vinylID'";
            $query = mysqli_query($connection, $sql);

            echo "Your vinyl data was updated successfully." . $errorLinkToAccount;
        }

        if ($_FILES['photo']['name'] != "") {
            // Check if the form was submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Check if file was imagesed without errors
                if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {

                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "webp" => "image/webp");
                    $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!array_key_exists($ext, $allowed)) {
                        echo "Error: Please select a valid file format." . $errorLinkToAccount;
                        exit();
                    }
                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize) {
                        echo "Error: File size is larger than the allowed limit" .  $errorLinkToAccount;
                        exit();
                    }

                    // Verify MIME type of the file
                    if (in_array($filetype, $allowed)) {
                        // Check whether file exists before imagesing it
                        if (file_exists("images/" . $_FILES["photo"]["name"])) {
                            echo $_FILES["photo"]["name"] . " already exists." . $errorLinkToAccount;
                        } else {

                            if (isset($_POST['update'])) {

                                $photopath = "images/" . $_FILES["photo"]["name"];
                                $vinylID = $_POST['vinylID'];

                                $sql = "UPDATE vinyl SET albumCover = '$photopath' WHERE vinylID = '$vinylID'";
                                $query = mysqli_query($connection, $sql);

                                move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $_FILES["photo"]["name"]);
                            }
                        }
                    } else {
                        echo "Error: There was a problem uploading your file. Please try again." . $errorLinkToAccount;
                    }
                } else {
                    echo "Error: " . $_FILES["photo"]["error"] . $errorLinkToAccount;
                }
            }
        }

        ?>
    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>