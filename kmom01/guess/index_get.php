<?php

/*
 *GET version of guess my number
 */

/*
require(__DIR__ . "/autoload.php");
require(__DIR__ . "/config.php");


/*
* Incoming GET variables


$number = $_GET["number"] ?? null;
$doInit = $_GET["doInit"] ?? null;
$doGuess = $_GET["doGuess"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;


/*
*Initiate the game


if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 6;
    header("Location: index_get.php?tries=$tries&number=$number");// shows in url so remove
}
elseif ($doGuess) {
    $tries=1;
    if($guess===$number) {
        $res = "Correct!!";
    } elseif ($guess>$number) {
        $res = "Too high!!";
    } else {
        $res = "Too low!!";
    }
}

/*
* Render the page in HTML
*/

/*

<h1>Let's play a game of "Guess my number"! (GET) </h1>
<p>Guess a number between 1 and 100. You have <?=// $tries ?> left.</p>

<form>
<input type="text" name="guess">
    <input type="hidden" name="number" value="<?= //$number ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start over">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php //if($doGuess) : ?>
<p>Your guess <?= //$guess ?> is <b><?= //$res ?></b></p>
<?//php endif; ?>
<?//php if($doCheat) : ?>
    <p>Cheat! Current number is <?= //$number ?></p>
<?php// endif; ?>

*/
