<?php $imgPath = App\Models\MovieModel::doesMovieImageExists($backdrop_path, "original", "") ?>

<head>
    <title><?= $title ?> - Movie App</title>

    <style>
        html {
            background-image: url(<?= $imgPath ?>);
        }
    </style>

    <link rel="stylesheet" href="/assets/styles/css/movie.style.css">

    <script>
        $(document).ready(function() {
            var cast = <?= json_encode($cast); ?>;
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

<?= view_cell("\App\Libraries\ViewCells::header") ?>

<div class="movie-container">
    <div class="movie-details">

        <?php
        $imgPath = App\Models\MovieModel::doesMovieImageExists($poster_path, "w300");
        ?>

        <img src="<?= $imgPath ?>">
        <div class="movie-overview">
            <?php
            echo "<h1>" . $title . "</h1>";
            echo "<span class='vote'>" . $vote_average . "</span>";

            if ($isMovieInWatchlist) {
                echo "<form method='POST' action='" . $_SERVER['REQUEST_URI'] . "/remove-from-watchlist' class='watchlist-button'>";
                echo "<button type='submit'>";
                echo "<img src='/public/assets/icons/bookmark_full.icon.png'>Remove from watchlist";
                echo "</button>";
                echo "</form>";
            } else {
                echo "<form method='POST' action='" . $_SERVER['REQUEST_URI'] . "/add-to-watchlist' class='watchlist-button'>";
                echo "<button type='submit'>";
                echo "<img src='/public/assets/icons/bookmark_empty.icon.png'>Add to watchlist";
                echo "</button>";
                echo "</form>";
            }

            echo "<p class='overview'>" . $overview . "</p>";
            echo "<p class='director'>Director: " . $crew['director'] . "</p>";

            echo "<div class='genres'>";
            echo "<p>Genres:</p>";
            for ($i = 0; $i < count($genres); $i++) {
                echo "<p>" . $genres[$i]['name'] . "</p>";
            }
            echo "</div>";
            ?>
        </div>
    </div>
    <div class="movie-info">
        <?php
        echo "<p>Release date: " . $release_date . "</p>";
        echo "<p>Runtime: " . $runtime . "</p>";
        echo "<p>Budget: $" . $budget . "</p>";
        ?>
    </div>
    <div class="cast">
        <h2>Actors</h2>
        <span class="cast-grid">
            <?php
            $cast = $cast;
            include_once __DIR__ . "/../included/cast.included.php";
            ?>
        </span>
        <button class="show-all-cast-btn">Show all</button>
    </div>
</div>