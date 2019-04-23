<?php
/**
 * Class Person2 is a standard class with methods and properties.
 */

class Person2
{
    /**
     * @var string $name The name entered
     * @var integer $age The age entered
     */
    private $name;
    private $age;


    /**
     * The method returns the details entered
     * @return string with details entered
     */
    public function details()
    {
        return "My name is {$this->name} and I am {$this->age} years old.";
    }
}
