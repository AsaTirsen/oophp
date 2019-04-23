<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/src/Person5.php");
include(__DIR__ . "/src/PersonAgeException.php");


//$person = new Person5("MegaMic");
//$person->setAge(-42);

//$person = new Person5("MegaMic", -42);

try {
    $person = new Person5("MegaMic");
    $person->setAge(-42);
} catch (PersonAgeException $e) {
    echo "Got exception: " . get_class($e) . "<hr>";
}

$person = new Person5("MegaMic", -42);


try {
    $person = new Person5("MegaMic", -42);
} catch (PersonAgeException $e) {
    echo "Got exception: " . get_class($e) . "<hr>";
}
$person = new Person5("MegaMic", -42);
var_dump($person);
