<?php

use PHPUnit\Framework\TestCase;
use App\Model\MovieModel;
use App\Data\MovieData;
use App\Exception\InvalidCountException;

class MovieModelTest extends TestCase
{
    private MovieModel $movieModel;

    protected function setUp(): void
    {
        $mockMovieData = $this->createMock(MovieData::class);
        $sampleMovies = [
            "When Harry Met Sally",
            "Good Will Hunting",
            "War of the Worlds",
            "Wonder Woman",
            "Mad Max",
            "The Wizard of Oz"
        ];
        $mockMovieData->method('getMovies')->willReturn($sampleMovies);

        $this->movieModel = new MovieModel($mockMovieData);
    }

    /**
     * @throws InvalidCountException
     */
    public function testGetRandomMovies(): void
    {
        $movies = $this->movieModel->getRandomMovies(3);
        $this->assertCount(3, $movies);
    }

    public function testGetRandomMoviesException(): void
    {
        $this->expectException(InvalidCountException::class);
        $this->movieModel->getRandomMovies(0);
    }

    public function testGetMoviesStartFromW(): void
    {
        $movies = $this->movieModel->getMoviesStartFromW();
        foreach ($movies as $movie) {
            $this->assertStringStartsWith('W', $movie);

            if (strlen($movie) % 2 == 1) {  // if the length is odd
                echo "The movie '{$movie}' has an odd number of characters: " . strlen($movie) . "\n";
            }
            $this->assertEquals(0, strlen($movie) % 2);
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