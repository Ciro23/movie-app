<?php $imgPath = MovieModel::doesMovieImageExists($data['backdrop_path'], "original", "") ?>
<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr" style="background-image: url(<?= $imgPath ?>)">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $data['title'] ?> - Movie App</title>

        <!-- styles and other files -->
        <?php include __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/movie.style.css">

        <!-- jQuery scripts -->
        <script>
        $(document).ready(function() {
            var cast = <?= json_encode($data['cast']); ?>;
            // shows all the cast
            $(".show-all-cast-btn").on("click", function() {
                var env = <?= json_encode($_ENV); ?>;

                $(this).css("display", "none");
                $(".cast-grid").load("/assets/show-more/cast.show-more.php", {
                    cast,
                    env,
                    includeCheck: true,
                });
            });

            if (cast.length <= 5) {
                $(".show-all-cast-btn").css("display", "none");
            }
        });
        </script>
    </head>
    <body>
        <?php include __DIR__ . "/../included/nav-bar.included.php" ?>
        
        <div class="movie-container">
            <div class="movie-details">

                <?php
                $imgPath = MovieModel::doesMovieImageExists($data['poster_path'], "w300");
                ?>

                <img src="<?= $imgPath ?>">
                <div class="movie-overview">
                    <?php
                    echo "<h1>" . $data['title'] . "</h1>";
                    echo "<span class='vote'>" . $data['vote_average'] . "</span>";

                    if ($data['isMovieInWatchlist']) {
                        echo "<form method='POST'>";
                        echo "<span>";
                        echo "<input type='submit' class='watchlist-button' id='remove-from-watchlist'>";
                        echo "<img src='/public/assets/icons/bookmark_empty.icon.png'>" . $lang['remove_from_watchlist'];
                        echo "</span>";
                        echo "</form>";
                    } else {
                        echo "<form method='POST'>";
                        echo "<span>";
                        echo "<input type='submit' class='watchlist-button' id='add-to-watchlist'>";
                        echo "<img src='/public/assets/icons/bookmark_empty.icon.png'>" . $lang['add_to_watchlist'];
                        echo "</span>";
                        echo "</form>";
                    }

                    echo "<p class='overview'>" . $data['overview'] . "</p>";
                    echo "<p class='director'>" . $lang['director'] . ": " . $data['crew']['director'] . "</p>";

                    echo "<div class='genres'>";
                    echo "<p>" . $lang['genres'] . ":</p>";
                    for ($i = 0; $i < count($data['genres']); $i++) {
                        echo "<p>" . $data['genres'][$i]['name'] . "</p>";
                    }
                    echo "</div>";         
                    ?>
                </div>
            </div>
            <div class="movie-info">
                <?php
                echo "<p>" . $lang['release_date'] . ": " . $data['release_date'] . "</p>";
                echo "<p>" . $lang['runtime'] . ": " . $data['runtime'] . "</p>";
                echo "<p>" . $lang['budget'] . ": $" . $data['budget'] . "</p>";
                ?>
            </div>
            <div class="cast">
                <h2><?= $lang['actors'] ?></h2>
                <span class="cast-grid">
                    <?php
                    $cast = $data['cast'];
                    include __DIR__ . "/../included/cast.included.php";
                    ?>
                </span>
                <button class="show-all-cast-btn"><?= $lang['show_all'] ?></button>
            </div>
        </div>
    </body>
</html>