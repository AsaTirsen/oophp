<?php


include(__DIR__ . "/src/Person4.php");

$object = new Person4("Astrid", 35);
var_dump($object);


$object = new Person4("Astrid");
echo $object->details();
var_dump($object);

$object = new Person4();
echo $object->details();
var_dump($object);
