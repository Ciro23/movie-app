<?= view_cell("\App\Libraries\ViewCells::header") ?>

<div class="movies-container">
    <?php
    if (isset($movie_filter)) {
        echo "<span class='filter-box'>";
        echo "<a href='/popular'>" . $lang['movie_filter']['popular'] . "</a>";
        echo "<a href='/now_playing'>" . $lang['movie_filter']['now_playing'] . "</a>";
        echo "<a href='/top_rated'>" . $lang['movie_filter']['top_rated'] . "</a>";
        echo "<a href='/upcoming'>" . $lang['movie_filter']['upcoming'] . "</a>";
        echo "</span>";
    } else {
        if ($total_results == 1) {
            echo "<h2 class='total-results'>" . $lang['total_results']['there_is'] . $total_results . $lang['total_results']["result_for"] . "\"" . $query . "\"</h2>";
        } else {
            echo "<h2 class='total-results'>" . $lang['total_results']['there_are'] . $total_results . $lang['total_results']["results_for"] . "\"" . $query . "\"</h2>";
        }
    }
    ?>

    <div class='movie-grid'>
        <?php
        foreach ($results as $index => $movie) {
            echo "<a href='/movie/" . $movie['id'] . "' class='movie'>";
            echo "<div>";

            //$imgPath = App\Models\MovieModel::doesMovieImageExists($movie['poster_path'], "w200");
            $imgPath = "https://image.tmdb.org/t/p/w200" . $movie['poster_path'];
            echo "<img src='$imgPath'>";
            echo "<p class='title'>" . $movie['title'] . "</p>";
            echo "<span class='vote'>" . $movie['vote_average'] . "</span>";
            echo "</div>";
            echo "</a>";
        }
        ?>
    </div>

    <div class="page-filter">
        <div class="filter-box">
            <?php
            // determines the base root of the url
            if (isset($movie_filter)) {
                $base = $movie_filter . "/";
            } else {
                $base = "search/" . $query . "/";
            }

            // shows previous page
            if ($page > 1) {
                $prev = $page - 1;
                echo "<a href='/" . $base . $prev . "'> < </a>";
            }

            // shows page numbers
            for ($i = $minPage; $i <= $maxPage; $i++) {
                if ($i == $page) {
                    echo "<a class='current-page'> " . $i . "</a>";
                } else {
                    echo "<a href='/" . $base . $i . "'> " . $i . "</a>";
                }
            }

            // shows next page
            if ($page < $total_pages) {
                $next = $page + 1;
                echo "<a href='/" . $base . $next . "'> > </a>";
            }
            ?>
        </div>
    </div>
</div>

<?= view_cell("\App\Libraries\ViewCells::footer") ?>