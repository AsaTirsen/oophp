<?php /** @noinspection PhpUndefinedVariableInspection */
namespace Anax\View;

?>

<h1>Spela tärning version 2</h1>
<p>Slå tärningen. Om du får en etta förlorar du alla poäng. Om du inte får en etta kan du välja att spara eller
    slå igen...</p>
<?php
if ($game->humanPlayer()->winner()) : ?>
    <p>The human won!</p>
    <form method="post">
        <input type="submit" name="reset" value="Play again">
    </form>
    <?php
elseif ($game->computerPlayer()->winner()) : ?>
    <p>The computer won!</p>
    <form method="post">
        <input type="submit" name="reset" value="Play again">
    </form>
    <?php
elseif ($game->humanTurn()) :
    ?>
    <form method="post">
        <input type="submit" name="humanroll" value="Roll for human">
        <input type="submit" name="save" value="Save your roll"/><br>
        <input type="submit" name="reset" value="Reset">
    </form>
    <?php
else :
    ?>
    <form method="post">
        <input type="submit" name="computerroll" value="Roll for computer"><br>
        <input type="submit" name="reset" value="Reset">
    </form>
<?php endif; ?>

<p>Human's dice</p>
<p class="dice-utf8">
    <?php
    foreach ($game->humanPlayer()->diceHand()->dices() as $dice) :
        ?>
        <i class="dice-sprite <?= $dice->graphic() ?>"></i>
    <?php endforeach;
    ?>
<p>Computer's dice</p>
<p class="dice-utf8">
    <?php
    foreach ($game->computerPlayer()->diceHand()->dices() as $dice) :
        ?>
        <i class="dice-sprite <?= $dice->graphic() ?>"></i>
    <?php endforeach; ?>


<p>Result of this turn for human player: <?= $game->humanPlayer()->turnScore() ?></p>
<p>Total result human player: <?= $game->humanPlayer()->savedScore() ?></p>
<p>Total result computer player: <?= $game->computerPlayer()->savedScore() ?></p>


<?php

?><h3>A histogram</h3>
<p>
    <?=$histogram->getAsAsterisk()?><br><br>
</p>



