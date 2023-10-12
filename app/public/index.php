<?php

require_once '../vendor/autoload.php';

use App\Controller\MovieController;
use App\Data\MovieData;
use App\Model\MovieModel;

$movieData = new MovieData();
$movieModel = new MovieModel($movieData);

$app = new MovieController($movieModel);

$uri = $_SERVER['REQUEST_URI'];
$uri = ltrim($uri, '/');

$result = match ($uri) {
    'case1' => $app->getRandomMovies(),
    'case2' => $app->getMoviesStartFromW(),
    'case3' => $app->getMultiWordMovies(),
    default => 'Hello world'
};

if ($result instanceof Exception) {
    echo $result->getMessage();
} else {
    echo '<pre>';
    print_r($result);
    echo '</pre>';
}



