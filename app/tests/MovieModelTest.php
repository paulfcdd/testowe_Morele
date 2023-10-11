<?php

use PHPUnit\Framework\TestCase;
use App\Model\MovieModel;  // Adjust the namespace according to your project structure.

class MovieModelTest extends TestCase
{
    private $movieModel;

    protected function setUp(): void
    {
        $this->movieModel = new MovieModel();
    }

    public function testGetRandomMovies(): void
    {
        $movies = $this->movieModel->getRandomMovies(3);
        $this->assertCount(3, $movies);
    }

    public function testGetMoviesStartFromW(): void
    {
        $movies = $this->movieModel->getMoviesStartFromW();
        foreach ($movies as $movie) {
            $this->assertStringStartsWith('W', $movie);

            $movieWithoutSpaces = str_replace(' ', '', $movie);
            if (strlen($movieWithoutSpaces) % 2 == 1) {  // if the length is odd
                echo "The movie '{$movie}' has an odd number of characters: " . strlen($movieWithoutSpaces) . "\n";
            }
            $this->assertEquals(0, strlen($movieWithoutSpaces) % 2);
        }
    }


    public function testGetMultiWordMovies(): void
    {
        $movies = $this->movieModel->getMultiWordMovies();

        $this->assertEquals($movies, array_unique($movies));

        foreach ($movies as $movie) {
            $this->assertGreaterThan(1, count(explode(' ', $movie)));
        }
    }

    protected function tearDown(): void
    {
        unset($this->movieModel);
    }
}