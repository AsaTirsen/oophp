<?php
namespace Anax\View;


?><!doctype html>
<meta charset="utf-8">
<title>Dice game</title>

<h1>Rolling a dicehand with five dices</h1>

<p><?= implode(", ", $hand->values()) ?></p>
<p>Sum is: <?= $hand->sum() ?>.</p>
<p>Average is: <?= $hand->average() ?>.</p>