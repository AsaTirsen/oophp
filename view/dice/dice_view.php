<?php
namespace Anax\View;

/**
 * Throw some graphic dices.
 */

?><h1>Spela tärning</h1>
<p>Slå tärningen. Om du får en etta förlorar du alla poäng. Om du inte får en etta kan du välja att spara eller
    slå igen...</p>

<form method="post">
    <input type="submit" name="roll" value="Roll the dice">
    <input type="submit" name="save" value="Save your roll"/>
    <input type="submit" name="reset" value="Reset">
</form>
<p>Rolling dice for <?= $game->activePlayer() ?></p>

<p>Result is: <?= var_dump($game->computerPlayer()->values()) ?></p>

<p class="dice-utf8">
    <?php
    $class = [];
    foreach ($class as $value) : ?>
        <i class="dice-sprite <?= $value ?>"></i>
    <?php endforeach; ?>
</p>
<p>Sum is: .</p>

