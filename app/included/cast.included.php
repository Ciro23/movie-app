<?php
if (isset($_POST['cast'])) {
    $cast = $_POST['cast'];
    $castLimit = count($cast);
    $_ENV = $_POST['env'];

    // re include all the needed classes
    include_once __DIR__ . "/../core/dbh.php";
    include_once __DIR__ . "/../core/model.php";
    include_once __DIR__ . "/../models/movie.model.php";
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
    $imgPath = MovieModel::doesMovieImageExists($cast[$i]['profile_path'], "w185");
    
    echo "<img src='$imgPath'>";
    echo "<p class='name'>" . $cast[$i]['name'] . "</p>";
    echo "<p class='character'>" . $cast[$i]['character'] . "</p>";
    echo "</div>";
}
?>