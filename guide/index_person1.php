<?php

include(__DIR__ . "/src/Person1.php");

$object = new Person1();
$object->age = 42;
$object->name = "MegaMic";

echo $object->details();
var_dump($object);
