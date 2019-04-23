
<h1>Let's play a game of "Guess my number"! (POST)</h1>
<p>Guess a number between 1 and 100. You have used <?= $guess->getTries() ?> out of 6 guesses.</p>

<form method="post">
    <input type="text" name="number">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start over">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($guess->lastResult != null) : ?>
    <p>Your guess <?= $guess->lastGuess ?> is <b><?= $guess->lastResult ?></b></p>
<?php elseif ($guess->lastResult === null) : ?>
<p>New game</p>
<?php endif;?>
<?php if ($_SESSION['doCheat'] != null) : ?>
    <p>Cheat! Current number is <?= $guess->getNumber() ?></p>
<?php endif; ?>

