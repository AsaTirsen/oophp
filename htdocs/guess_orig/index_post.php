<?php

/*
 *GET version of guess_orig my number
 */

require(__DIR__ . "/autoload.php");
require(__DIR__ . "/config.php");
require(__DIR__ . "/src/Guess.php");
require(__DIR__ . "/session.php");
require(__DIR__ . "/src/GuessException.php");


/*
* Incoming POST variables
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST["number"] ?? null;
    $tries = $_POST["tries"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $_SESSION['doCheat'] = $_POST["doCheat"] ?? null;

    /*
    * Three options for action - initialize new game, guess_orig or cheat
    * try catch for exception when $number is negative or >100.
    */
    if ($guess->getTries() >= 6) {
        $guess->init();
    } elseif ($doGuess) {
        $guess->makeGuess($number);
    } elseif ($doInit) {
        $guess->init();
    }
    header("Location: $_SERVER[REQUEST_URI]", true, 302);
    die();
 //else {
    //require(__DIR__ . "/view/guess_game_post.php");
}
