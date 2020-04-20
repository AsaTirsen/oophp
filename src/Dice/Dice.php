<?php
namespace Asatir\Dice;

/**
 * A dice with sides and graphic representation .
 */
class Dice
{
    private $lastRoll;

    /**
     * Constructor to initiate the object with values of dice 1-6
     * @param int sides
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * returns the result of the last roll
     * @return mixed
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    /**
     * roll sets last roll to a random number and returns it
     * @return int
     */
    public function roll()
    {
        $this->lastRoll = rand(1, 6);
        return $this->lastRoll;
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }

    /**
     * Override the dice roll for testing.
     * @param int $roll
     */
    public function fakeRoll(int $roll)
    {
        $this->lastRoll = $roll;
    }
}
