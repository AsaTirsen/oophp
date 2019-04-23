<?php

include(__DIR__ . "/src/Person3.php");

$objectname = new Person3();
$objectage = new Person3();


$objectname->setName("Åsa");
$objectage->setAge(40);

$objectname->getName();
$objectage->getAge();
var_dump($objectname);
