<?php
/**
 * Class Person3 is a standard class with methods and properties.
 */

class Person3
{
    /**
     * @var string $name The name entered
     * @var integer $age The age entered
     */
    private $name;
    private $age;

    /* Set the age of the person.
    *
    * @param int $age The age of the person.
    *
    * @return void
    */

    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /* Set the name of the person.
     *
     * @param string $name The name of the person.
     *
     * @return void
     */

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the age of the person.
     *
     * @return int as the age of the person.
     */
    public function getAge()
    {
        return " My age is: " . $this->age;
    }


    /**
     * Get the name of the person.
     *
     * @return string as the name of the person.
     */
    public function getName()
    {
        return "My name is: " . $this->name;
    }


    /**
     * The method returns the details entered
     * @return string with details entered
     */
    public function details()
    {
        return "My name is {$this->name} and I am {$this->age} years old.";
    }
}
