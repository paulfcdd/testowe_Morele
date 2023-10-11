<?php

namespace App\Controller;

use App\Model\MovieModel;

class MovieController
{
    private MovieModel $movieModel;

    public function __construct()
    {
        $this->movieModel = new MovieModel();
    }

    public function getRandomMovies(): array
    {
        return $this->movieModel->getRandomMovies();
    }

    public function getMoviesStartFromW(): array
    {
        return $this->movieModel->getMoviesStartFromW();
    }

    public function getMultiWordMovies(): array
    {
        return $this->movieModel->getMultiWordMovies();
    }
}
