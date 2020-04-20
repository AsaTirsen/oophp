<?php
namespace Asti\Dice;

class Dice
{
    private $lastRoll;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    public function roll()
    {
        $this->lastRoll = rand(1, 6);
        return $this->lastRoll;
    }
}
