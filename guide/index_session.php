<?php


include(__DIR__ . "/config.php");
include(__DIR__ . "/src/Person5.php");
include(__DIR__ . "/autoload.php");


session_name("asti18");
session_start();


if (!isset($_SESSION["person"])) {
    $_SESSION["person"] = new Person5("MegaMic", 42);
}

$person = $_SESSION["person"];
$age = $person->getAge();
$person->setAge($age + 1);
echo $person->details();
var_dump($person);
