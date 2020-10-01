<?php

class MovieModel extends Model {

    private function formatDate($date) {
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");

        return $date;
    }

    private function formatRuntime($runtime) {
        $hrs = floor($runtime / 60);
        $mins = $runtime - $hrs * 60;

        return $hrs . "h " . $mins . "m";
    }

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

    private function getMinPage($page) {
        for ($i = $page; $i >= $page - 3 && $i > 0; $i--) {
            $minPage = $i;
        }

        return $minPage;
    }

    private function getMaxPage($page, $total_pages) {
        $maxPage = 0;
        for ($i = $page; $i <= $page + 3 && $maxPage < $total_pages; $i++) {
            $maxPage = $i;
        }

        return $maxPage;
    }

    // gets the cast and the crew of the movie
    private function getCredits($id) {
        // get the json file into a string variable
        $tmdbUrl = "https://api.themoviedb.org/3/movie/"
        . $id
        . "/credits?api_key="
        . $_ENV['apiKey'];
        
        $json = @file_get_contents($tmdbUrl);

        return json_decode($json, true);
    }

    // find the movie director
    private function getDirector($crew) {
        for ($i = 0; $i < count($crew); $i++) {
            if ($crew[$i]['job'] == "Director") {
                return $crew[$i]['name'];
            }
        }
    }

    // return a specific movie details
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
        }
        
        return $data;
    }

    // return a list of movies sorted differently
    public function getList($filter, $page) {
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

    // return a list of movie by searched title
    public function search($query, $page) {
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
            // saves the current query
            $query = str_replace("%20", " ", $query);
            $data['query'] = $query;

            // gets the minimum and the maximum page
            $data['minPage'] = $this->getMinPage($data['page']);
            $data['maxPage'] = $this->getMaxPage($data['page'], $data['total_pages']);
        }

        return $data;
    }
}