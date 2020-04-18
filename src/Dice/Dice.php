<?php
namespace Asatir\Dice;

/**
 * A dice with sides and graphic representation .
 */
class Dice {

    private $lastRoll;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    public function roll() {
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
