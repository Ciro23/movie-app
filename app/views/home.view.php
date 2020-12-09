<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - Movie App</title>

        <!-- styles and other files -->
        <?php include __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/home.style.css">

        <!-- jQuery scripts -->
        <script>
        $(document).ready(function() {
            // animates the movie card when hovering
            $(".movie").hover(function() {
                $(this).animate({top: "-20"}, 150);
            }, function() {
                $(this).animate({top: "0"}, 150);
            });
        });
        </script>

    </head>
    <body>
        <?php include __DIR__ . "/../included/nav-bar.included.php" ?>

        <div class="movies-container">
            <?php
            if (isset($data['movie_filter'])) {
                    echo 
                    "<span class='filter-box'>
                        <a href='/popular'>" . $lang['movie_filter']['popular'] . "</a>
                        <a href='/now_playing'>". $lang['movie_filter']['now_playing'] . "</a>
                        <a href='/top_rated'>" . $lang['movie_filter']['top_rated'] . "</a>
                        <a href='/upcoming'>" . $lang['movie_filter']['upcoming'] . "</a>
                    </span>";
                } else {
                    if ($data['total_results'] == 1) {
                        echo "<h2 class='total-results'>" . $lang['total_results']['there_is'] . $data['total_results'] . $lang['total_results']["result_for"] . "\"" . $data['query'] . "\"</h2>";
                    } else {
                        echo "<h2 class='total-results'>" . $lang['total_results']['there_are'] . $data['total_results'] . $lang['total_results']["results_for"] . "\"" . $data['query'] . "\"</h2>";
                    }
                }
                ?>

                <div class='movie-grid'>
                <?php
                for ($i = 0; $i < count($data['results']); $i++) {
                    echo "<a href='/movie/" . $data['results'][$i]['id'] . "' class='movie'>";
                    echo "<div>";

                    $imgPath = MovieModel::doesMovieImageExists($data['results'][$i]['poster_path'], "w200");

                    echo "<img src='$imgPath'>";
                    echo "<p class='title'>" . $data['results'][$i]['title'] . "</p>";
                    echo "<span class='vote'>" . $data['results'][$i]['vote_average'] . "</span>";
                    echo "</div>";
                    echo "</a>";
                }
                ?>
                </div>

                <div class="filter">
                    <span class="filter-box page-filter">
                        <?php
                        // determines the base root of the url
                        if (isset($data['movie_filter'])) {
                            $base = $data['movie_filter'] . "/";
                        } else {
                            $base = "search/" . $data['query'] . "/";
                        }

                        // shows previous page
                        if ($data['page'] > 1) {
                            $prev = $data['page'] - 1;
                            echo "<a href='/" . $base . $prev . "'> < </a>";
                        }

                        // shows page numbers
                        for ($i = $data['minPage']; $i <= $data['maxPage']; $i++) {
                            if ($i == $data['page']) {
                                echo "<a class='current-page'> " . $i . "</a>";
                            } else {
                                echo "<a href='/" . $base . $i . "'> " . $i . "</a>";
                            }
                        }

                        // shows next page
                        if ($data['page'] < $data['total_pages']) {
                            $next = $data['page'] + 1;
                            echo "<a href='/" . $base . $next . "'> > </a>";
                        }
                        ?>
                    </span>
                </span>
        </div>
    </body>
</html>