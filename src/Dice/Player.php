<?php

namespace Asatir\Dice;

/**
 * class Player that initiates a player and keeps track of score per round and total score
 **/
class Player
{
    private $diceHand;
    private $savedScore;
    private $turnScore;

    public function __construct()
    {
        $this->diceHand = new DiceHand();
        $this->savedScore = 0;
        $this->turnScore = 0;
    }

    public function turnScore() {
        return $this->turnScore;
    }

    public function savedScore() {
        return $this->savedScore;
    }

    public function roll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0) {
        $this->diceHand->roll();
        // Handle fake rolls for testing purposes
        if ($roll1 != 0) {
            $this->diceHand->fakeRoll(0, $roll1);
        }
        if ($roll2 != 0) {
            $this->diceHand->fakeRoll(1, $roll2);
        }
        if ($roll3 != 0) {
            $this->diceHand->fakeRoll(2, $roll3);
        }

        if ($this->diceHand->checkIfOne()) {
            $this->turnScore = 0;
        } else {
            $this->turnScore += $this->diceHand->sum();
        }
    }

    public function saveTurn() {
        $this->savedScore += $this->turnScore;
        $this->turnScore = 0;
    }
}
