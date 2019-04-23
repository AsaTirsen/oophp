<?php
namespace Mos\Person;

/**
 * Showing off a standard class with methods and properties.
 */

class Person
{
    /**
     * @var string $name The name entered
     * @var integer $age The age entered
     */
    public $name;
    public $age;

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
        return $this->age;
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

    /**
     * Constructor to create a Person.
     *
     * @param string $name The name of the person.
     * @param int $age The age of the person.
     */
    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }


    /**
     * Constructor to create a Person, where params are empty
     *
     * @param null|string $name The name of the person.
     * @param null|int $age The age of the person.
     */
    /*public function __construct(string $name = null, int $age = null)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * Destroy a Person.
     */
    /*  public function __destruct()
      {
          echo __METHOD__;
      }*/


    /**
     * Set the age of the person.
     *
     * @throws PersonAgeException when age is negative.
     *
     * @param int $age The age of the person.
     *
     * @return void
     */
    /*  public function setAge(int $age)
      {
          if (!(is_int($age) && $age >= 0)) {
              throw new PersonAgeException("Age is only allowed to be a positive integer.");
          }
          $this->age = $age;
      }*/
}
