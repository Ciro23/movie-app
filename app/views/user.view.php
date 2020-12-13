<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $data['username'] ?> - Movie App</title>

        <!-- styles and other files -->
        <?php include_once __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/user.style.css">

        <!-- movie grid animation script -->
        <script src="/assets/js-scripts/movie-grid.script.js"></script>
    </head>
    <body>
        <?php include_once __DIR__ . "/../included/nav-bar.included.php" ?>

        <div class="user-container">
            <div class="user-header">
                <h1><?= $data['username'] ?></h1>
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] == $data['username']) {
                    echo "<a href='/logout'>Logout</a>";
                }
                ?>
            </div>
            <div class="movie-grid">
                <?php
                if (count($data['watchlist'])) {
                    foreach($data['watchlist'] as $index => $movie) {
                        echo "<a href='/movie/" . $movie['id'] . "' class='movie'>";
                        echo "<div>";
    
                        $imgPath = MovieModel::doesMovieImageExists($movie['poster_path'], "w200");
    
                        echo "<img src='$imgPath'>";
                        echo "<p class='title'>" . $movie['title'] . "</p>";
                        echo "<span class='vote'>" . $movie['vote_average'] . "</span>";
                        echo "</div>";
                        echo "</a>";
                    }
                } else {
                    echo "<p class='empty-list'>" . $lang['user']['empty_watchlist'] . "</p>";
                }
                ?>
            </div>
        </div>
        <?php include_once __DIR__ . "/../included/footer.included.php" ?>
    </body>
</html>