<?php

/*
 *GET version of guess my number
 */

require(__DIR__ . "/autoload.php");
require(__DIR__ . "/config.php");
require(__DIR__ . "/src/Dice/Dice.php");
require(__DIR__ . "/index_session_dice.php");

//$res []= $dice->diceRolls();

$counter = 1;
$diceArray = array();
$resArray = array();
$res;
while($counter <= 6) {
    $res = $dice->diceRolls();
    $resArray = array_push($diceArray, $res);
    $counter++;
} var_dump($resArray);


?>
/*
* Render the page in HTML
*/



<h1>Let's get a number </h1>
<p>Empty paragraph.</p>
    <ol>
    <li>yikes</li>
    <li>Tea</li>
    <li>Milk</li>
</ol>



