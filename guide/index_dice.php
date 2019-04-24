<?php
namespace Asti\Dice;
/*
 *GET version of guess my number
 */

require(__DIR__ . "/autoload_namespace.php");
require(__DIR__ . "/config.php");
require(__DIR__ . "/src/Dice/Dice.php");

//$res []= $dice->diceRolls();

$dice = new Dice();
$counter = 1;
$diceArray = array();
$resArray = array();
while ($counter <= 6) {
    $res = $dice->roll();
    array_push($diceArray, $res);
    $counter++;
}

foreach ($diceArray as $key => $res) {
    $key = $key+1;
    print_r("<li>$key . $res</li><br>");
}
$arraySum = array_sum($diceArray);

print_r("<p>Summan är: $arraySum<br></p>");

$arrayAve = array_sum($diceArray)/count($diceArray);

$roundAve = round($arrayAve, 2);

print_r ("<p>Medelvärdet är: $roundAve</p>");

?>




