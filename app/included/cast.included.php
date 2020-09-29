<?php
if (isset($_POST['cast'])) {
    $cast = $_POST['cast'];
    $castLimit = count($cast);
    $_ENV = $_POST['env'];

    include __DIR__ . "/../included/php-functions.included.php";
} else {
    if (count($cast) >= 5) {
        $castLimit = 5;
    } else {
        $castLimit = count($cast);
    }
}

for ($i = 0; $i < $castLimit; $i++) {
    echo "<div class='cast-card'>";

    // checks if the actor image exists
    $imgPath = imageExists($cast[$i]['profile_path'], "w185");
    
    echo "<img src='$imgPath'>";
    echo "<p class='name'>" . $cast[$i]['name'] . "</p>";
    echo "<p class='character'>" . $cast[$i]['character'] . "</p>";
    echo "</div>";
}
?>