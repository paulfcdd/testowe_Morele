<?php

namespace App\Model;

use App\Data\MovieData;

class MovieModel
{
    private array $movies;

    public function __construct()
    {
        $this->movies = (new MovieData())->getMovies();
    }

    /**
     * @throws \Exception
     */
    public function getRandomMovies(int $count = 3): array
    {
        if ($count <= 0) {
            throw new \Exception('Parameter should be greater or equal than 0');
        }

        $randomKeys = array_rand($this->movies, $count);

        return array_intersect_key($this->movies, array_flip($randomKeys));
    }

    public function getMoviesStartFromW(): array
    {
        $filteredMovies = [];

        foreach ($this->movies as $movie) {
            $movieWithoutSpaces = str_replace(' ', '', $movie);

            if (str_starts_with($movie, 'W') && !in_array($movie, $filteredMovies)) {
                if (mb_strlen($movieWithoutSpaces) % 2 === 0) {
                    $filteredMovies[] = $movie;
                }
            }
        }

        return $filteredMovies;
    }

    public function getMultiWordMovies(): array
    {
        $filteredMovies = [];

        foreach ($this->movies as $movie) {
            if (count(explode(' ', trim($movie))) > 1) {
                $filteredMovies[] = $movie;
            }
        }

        return array_unique($filteredMovies);
    }
}