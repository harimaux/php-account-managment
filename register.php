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
        <form action="register_complete.php" method="POST">
            <input type="text" name="firstName" placeholder="First name.." required>
            <input type="text" name="sureName" placeholder="Surename..">
            <input type="text" name="phoneNr" placeholder="Phone number..">
            <input type="email" name="email" placeholder="Email..">
            <input type="password" name="password" placeholder="Password..">
            <div class="register_submit_btn"><input type="submit" name="submitUser" value="Register"></div>
        </form>
    </div>

    <?php include 'common/footer.php'; ?>

</body>

</html>