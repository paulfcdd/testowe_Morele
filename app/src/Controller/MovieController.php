<?php

namespace App\Controller;

use App\Exception\InvalidCountException;
use App\Model\MovieModel;

class MovieController
{
    private MovieModel $movieModel;

    public function __construct(MovieModel $movieModel)
    {
        $this->movieModel = $movieModel;
    }

    /**
     * @throws InvalidCountException
     */
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
