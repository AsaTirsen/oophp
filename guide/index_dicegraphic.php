<?php
namespace Asti\Dice;

/**
* Throw some graphic dices.
*/
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload_namespace.php");


$dice = new DiceGraphic();
$rolls = 6;
$res = [];
$class = [];
for ($i = 0; $i < $rolls; $i++) {
$res[] = $dice->roll();
$class[] = $dice->graphic();
}



?>

<!doctype html>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<h1>Rolling <?= $rolls ?> graphic dices</h1>

<p class="dice-utf8">
    <?php foreach($class as $value) : ?>
        <i class="dice-sprite <?= $value ?>"></i>
    <?php endforeach; ?>
</p>
<p><?= implode(", ", $res) ?></p>
<p>Sum is: <?= array_sum($res) ?>.</p>
<p>Average is: <?= round(array_sum($res) / 6, 1) ?>.</p>



