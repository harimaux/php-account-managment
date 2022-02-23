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
    <title>Vinyls Online - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'common/header.php'; ?>

    <div class="register_login_background"></div>

    <div class="register_container">
        <?php include('common/dbConn.php');

        if (isset($_POST['submitUser'])) {

            $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
            $sureName = mysqli_real_escape_string($connection, $_POST['sureName']);
            $phoneNr = mysqli_real_escape_string($connection, $_POST['phoneNr']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);

            $passwordInput = $_POST['password'];

            $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
            $checkEmailResults = mysqli_query($connection, $checkEmailQuery);

            while ($row = mysqli_fetch_array($checkEmailResults)) {

                $checkDoubleEmail = $row['email'];
            }

            if (!empty($checkDoubleEmail) == $email) {

        ?>

        <h3>Registration failed, email already exists - <span><a href="register.php">back to register page</a></span>
        </h3>

        <?php
            } else {

                if (defined('PASSWORD_ARGON2ID')) {
                    $hashedPass = password_hash($passwordInput, PASSWORD_ARGON2ID, array('time_cost' => 10, 'memory_cost' => '2048k', 'threads' => 6));
                } else {
                    $hashedPass = password_hash($passwordInput, PASSWORD_DEFAULT, array('time_cost' => 10, 'memory_cost' => '2048k', 'threads' => 6));
                }

                $inputQuery = "INSERT INTO users (firstName, sureName, email, phoneNr, password) VALUES ('$firstName', '$sureName', '$email', '$phoneNr', '$hashedPass')";


                if (!mysqli_query($connection, $inputQuery)) {
                    echo "Error: " . $inputQuery . "<br>" . mysqli_error($connection);
                } else {

                ?>
        <h3>Registration complete - <span><a href="login.php">back to login page</a></span></h3>
        <?php
                }

                mysqli_close($connection);
            }
        }

        ?>

    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>