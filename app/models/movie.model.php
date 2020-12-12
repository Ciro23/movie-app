<?php

class MovieModel extends Model {

    /*
    * checks if the image of a movie exists
    *
    * @param string $image, the image path
    * @param string $width, the image width (original, w200...)
    * @param string $replace, if the image must be replaced with a default one in case of missing
    *
    * @return string, the image path
    */
    public static function doesMovieImageExists($image, $width, $replace = "yes") {
        if ($replace == "yes") {
            $replace = $_ENV['defaultImgPath'];
        }
        
        if ($image == null) {
            return $replace;
        }

        return $_ENV['imageBaseUrl'] . $width . $image;
    }

    /*
    * returns a movie list sorted in different ways
    *
    * @param string $filter, the filter to select movies
    * @param string $page
    *
    * @return array, containing all the data
    */
    public function getMovieList($filter, $page) {
        // get the json file into a string variable
        $tmdbUrl = "https://api.themoviedb.org/3/movie/"
        . $filter
        . "?api_key="
        . $_ENV['apiKey']
        . "&language="
        . $_COOKIE['language']
        . "&page="
        . $page
        . "&region="
        . $_COOKIE['language'];

        $json = @file_get_contents($tmdbUrl);
        
        if ($data = json_decode($json, true)) {
            // saves the current movie filter
            $data['movie_filter'] = $filter;

            // gets the minimum and the maximum page
            $data['minPage'] = $this->getMinPage($data['page']);
            $data['maxPage'] = $this->getMaxPage($data['page'], $data['total_pages']);
        }

        return $data;
    }

    /*
    * searches for movies
    *
    * @param string $filter, the filter to select movies
    * @param string $page
    *
    * @return array, containing all the data
    */
    public function searchMovie($query, $page) {
        $tmdbUrl = "https://api.themoviedb.org/3/search/movie?api_key="
        . $_ENV['apiKey']
        . "&language="
        . $_COOKIE['language']
        . "&query="
        . $query
        . "&page="
        . $page
        . "&region="
        . $_COOKIE['language'];
        
        $json = @file_get_contents($tmdbUrl);
        
        if ($data = json_decode($json, true)) {
            // formats and saves the current query
            $query = str_replace("%20", " ", $query);
            $query = urldecode($query);
            $data['query'] = $query;

            // gets the minimum and the maximum page
            $data['minPage'] = $this->getMinPage($data['page']);
            $data['maxPage'] = $this->getMaxPage($data['page'], $data['total_pages']);
        }

        return $data;
    }

    /*
    * returns details of a specific movie
    *
    * @param int $id, the movie id
    *
    * @return array, containing all the data
    */
    public function getMovieDetails($id) {
        // get the json file into a string variable
        $tmdbUrl = "https://api.themoviedb.org/3/movie/"
        . $id
        . "?api_key="
        . $_ENV['apiKey']
        . "&language="
        . $_COOKIE['language'];

        $json = @file_get_contents($tmdbUrl);

        if ($data = json_decode($json, true)) {
            // formats the date, the budget and the runtime
            $data['release_date'] = $this->formatDate($data['release_date']);
            $data['budget'] = $this->formatBudget($data['budget']);
            $data['runtime'] = $this->formatRuntime($data['runtime']);

            // adds the cast to the data array
            $data = array_merge($data, $this->getCredits($id));
            // saves the director name
            $data['crew']['director'] = $this->getDirector($data['crew']);

            // checks if the movie is in the watchlist of the current user
            $data['isMovieInWatchlist'] = $this->isInWatchlist($id);
        }
        
        return $data;
    }

    /*
    * gets the movies details from the user watchlist
    *
    * @param array $watchlist, an array containing all the movies id
    *
    * @return array
    */
    public function getMoviesFromWatchlist($watchlist) {
        $data = [];
        if (count($watchlist)) {
            foreach($watchlist as $index => $movie) {
                $movieId = $movie['movie'];
                $data[$index] = $this->getMovieDetails($movieId);
            }
        }
        return $data;
    }

    /*
    * adds a movie to the user watchlist
    *
    * @param int $id, the movie id
    */
    public function addToWatchlist($id) {
        $sql = "INSERT INTO watchlist (movie, user) VALUES (?, ?)";
        $this->executeStmt($sql, [$id, $_SESSION['username']]);
    }

    /*
    * removes a movie from the user watchlist
    *
    * @param int $id, the movie id
    */
    public function removeFromWatchlist($id) {
        $sql = "DELETE FROM watchlist WHERE movie = ? AND user = ?";
        $this->executeStmt($sql, [$id, $_SESSION['username']]);
    }

    /*
    * checks if a movie is in the user watchlist
    *
    * @param int $id, the movie id
    *
    * @return bool, success status
    */
    private function isInWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $sql = "SELECT COUNT(*) FROM watchlist WHERE movie = ? AND user = ?";
            if ($query = $this->executeStmt($sql, [$id, $_SESSION['username']])) {
                if ($query->fetch(PDO::FETCH_COLUMN) == 1) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
    * formats the date
    *
    * @param string $date
    *
    * @return string, the formatted date
    */
    private function formatDate($date) {
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");

        return $date;
    }

    /*
    * formats the runtime
    *
    * @param string $runtime
    *
    * @return string, the formatted runtime
    */
    private function formatRuntime($runtime) {
        $hrs = floor($runtime / 60);
        $mins = $runtime - $hrs * 60;

        return $hrs . "h " . $mins . "m";
    }

    /*
    * formats the budget
    *
    * @param string $budget
    *
    * @return string, the formatted budget
    */
    private function formatBudget($budget) {
        $budget = strval($budget);
        $budgetNew = "";

        for ($i = 1; $i <= strlen($budget); $i++) {
            $budgetNew .= $budget[strlen($budget) - $i];
            if ($i % 3 == 0 && $i != strlen($budget)) {
                $budgetNew .= ".";
            }
        }

        return strrev($budgetNew);
    }

    /*
    * gets the minimum page to display in the page selection menu
    *
    * @param int $page
    *
    * @return int, the minimum page
    */
    private function getMinPage($page) {
        for ($i = $page; $i >= $page - 3 && $i > 0; $i--) {
            $minPage = $i;
        }

        return $minPage;
    }

    /*
    * gets the maximum page to display in the page selection menu
    *
    * @param int $page
    * @param int $total_pages
    *
    * @return int, the maximum page
    */
    private function getMaxPage($page, $total_pages) {
        $maxPage = 0;
        for ($i = $page; $i <= $page + 3 && $maxPage < $total_pages; $i++) {
            $maxPage = $i;
        }

        return $maxPage;
    }

    /*
    * gets the cast and the crew details
    *
    * @param int $id, the movie id
    *
    * @return array, containing all the cast and crew data
    */
    private function getCredits($id) {
        // get the json file into a string variable
        $tmdbUrl = "https://api.themoviedb.org/3/movie/"
        . $id
        . "/credits?api_key="
        . $_ENV['apiKey'];
        
        $json = @file_get_contents($tmdbUrl);

        return json_decode($json, true);
    }

    /*
    * gets the director name
    *
    * @param array $crew
    *
    * @return string, the director name
    */
    private function getDirector($crew) {
        for ($i = 0; $i < count($crew); $i++) {
            if ($crew[$i]['job'] == "Director") {
                return $crew[$i]['name'];
            }
        }
    }
}