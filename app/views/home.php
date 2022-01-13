<?= view_cell("\App\Libraries\ViewCells::header") ?>

<div class="movies-container">
    <?php
    if (isset($movie_filter)) {
        echo "<span class='filter-box'>";
        echo "<a href='/popular'>" . "Popular" . "</a>";
        echo "<a href='/now_playing'>" . "Now playing" . "</a>";
        echo "<a href='/top_rated'>" . "Top rated" . "</a>";
        echo "<a href='/upcoming'>" . "Upcoming" . "</a>";
        echo "</span>";
    } else {
        if ($total_results == 1) {
            $correctWord = "There is ";
        } else {
            $correctWord = "There are ";
        }
        echo "<h2 class='total-results'>" . $correctWord . $total_results . "total results for " . "\"" . $query . "\"</h2>";
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