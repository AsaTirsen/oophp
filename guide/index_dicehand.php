<?php

namespace Asti\Dice;

/**
* Throw a hand of dices.
*/
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");
require(__DIR__ . "/src/Dice/Dice.php");
require(__DIR__ . "/src/Dice/DiceHand.php");


$hand = new DiceHand();
$hand->roll();

?><h1>Rolling a dicehand with five dices</h1>

<p><?= implode(", ", $hand->values()) ?></p>
<p>Sum is: <?= $hand->sum() ?>.</p>
<p>Average is: <?= $hand->average() ?>.</p>