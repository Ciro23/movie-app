<?php

namespace Tests;

use App\Models\MovieModel;
use CodeIgniter\Test\CIUnitTestCase;

class MovieModelTest extends CIUnitTestCase {

    public function test_get_movie_list() {
        $model = new MovieModel();
        $result = $model->getMovieList("popular", 1);

        var_dump($result);
    }
}
