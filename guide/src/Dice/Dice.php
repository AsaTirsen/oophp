<?php
namespace Asti\Dice;

class Dice {

    private $value;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function value()
    {
        return $this->value;
    }

    public function roll() {
        $this->value = rand(1, 6);
        return $this->value;
    }

    public function getLastRoll()
    {
        $lastRoll = $this->roll();
        return $lastRoll;
    }

}



