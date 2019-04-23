<?php
//$object = new stdClass();
//var_dump($object);

$object = new stdClass();
$object->age = 42;
$object->details = function () {
    echo "Hi, I'm an object!";
};

echo ($object->details)() . " " . $object->age;
var_dump($object);
