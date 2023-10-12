<?php

namespace App\Model;

use App\Data\MovieData;
use App\Exception\InvalidCountException;

class MovieModel
{
    private array $movies;

    public function __construct(MovieData $movieData)
    {
        $this->movies = $movieData->getMovies();
    }

    /**
     * @throws InvalidCountException
     */
    public function getRandomMovies(int $count = 3): array
    {
        if ($count <= 0) {
            throw new InvalidCountException();
        }

        $randomKeys = array_rand($this->movies, $count);

        return array_intersect_key($this->movies, array_flip($randomKeys));
    }

    public function getMoviesStartFromW(): array
    {
        $filteredMovies = [];

        foreach ($this->movies as $movie) {
            if (str_starts_with($movie, 'W')) {
                if (mb_strlen($movie) % 2 === 0) {
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