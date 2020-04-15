<?php

namespace Asti\Dice;

/**
* Throw a hand of dices.
*/
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");
require(__DIR__ . "/src/Dice.php");
require(__DIR__ . "/src/DiceHand.php");


$hand = new DiceHand();
$hand->roll();

?><h1>Rolling a dicehand with five dices</h1>

<p><?= implode(", ", $hand->values()) ?></p>
<p>Sum is: <?= $hand->sum() ?>.</p>
<form method="post">
    <input type="submit" name="save" value="Save and quit">
    <input type="submit" name="newRoll" value="Roll again">
</form>
<p>Average is: <?= $hand->average() ?>.</p>

<?php
    if ($_GET["save"] != null) {
        return "saved";
    }

