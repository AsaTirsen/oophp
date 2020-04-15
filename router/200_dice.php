<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Initialize game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game;
    $game = new Asatir\Guess\GuessB();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("dice/play");
});


/**
 * Play the game - show game status
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    // Get the current settings from session
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;


    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;


    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "doInit" => $doInit ?? null,
    ];
    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");


    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    // Deal with incoming variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $_SESSION["doCheat"] = $doCheat;

    if ($doInit) {
        // Init the game;
        $game = new Asatir\Guess\GuessB();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
    }

    if ($doGuess) {
        error_log('doGuess');
        //Do a guess
        $game = new Asatir\Guess\GuessB($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;

        if ($_SESSION["tries"] < 0) {
            $game = new Asatir\Guess\GuessB();
            $_SESSION["number"] = $game->number();
            $_SESSION["tries"] = $game->tries();
        }
    }
    return $app->response->redirect("guess/play");
});

//
//$dice = new Dice();
//$counter = 1;
//$diceArray = array();
//$resArray = array();
//while ($counter <= 6) {
//    $res = $dice->roll();
//    array_push($diceArray, $res);
//    $counter++;
//}
//
//foreach ($diceArray as $key => $res) {
//    $key = $key+1;
//    print_r("<li>$key . $res</li><br>");
//}
//$arraySum = array_sum($diceArray);
//
//print_r("<p>Summan är: $arraySum<br></p>");
//
//$arrayAve = array_sum($diceArray)/count($diceArray);
//
//$roundAve = round($arrayAve, 2);
//
//print_r ("<p>Medelvärdet är: $roundAve</p>");
//
//
//$hand = new DiceHand();
//$hand->roll();
