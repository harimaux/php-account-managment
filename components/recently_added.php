<h1 class="recently_added_heading">Recently Added Vinyl&apos;s</h1>

<div class="recently_added_container">

    <?php

    include "common/dbConn.php";

    $sql = "SELECT * FROM vinyl ORDER BY dateAdded DESC LIMIT 12";

    $results = mysqli_query($connection, $sql);

    ?>

    <?php

    while ($row = mysqli_fetch_array($results)) {

        $artist = $row["artist"];
        $price = $row["price"];
        $image = $row["albumCover"];

    ?>

    <div class="recently_added_box">
        <img src="<?= $image ?>" alt="<?= $artist ?> vinyl cover image">
        <p>Artist: <?= $artist ?></p>
        <p>Price: <?= $price ?></p>
    </div>

    <?php

    }

    ?>

</div>