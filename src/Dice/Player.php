<?php

namespace Asatir\Dice;

/**
 * class Player that initiates a player and keeps track of score per round and total score
 **/
class Player
{
    /**
     * @var DiceHand
     */
    private $diceHand;
    private $savedScore;
    private $turnScore;

    /**
     * Player constructor.
     * Initiates new instance of DiceHand() and score variables to 0
     */
    public function __construct()
    {
        $this->diceHand = new DiceHand();
        $this->savedScore = 0;
        $this->turnScore = 0;
    }

    /**
     * Returns turnscore (score for current turn)
     * @return int
     */
    public function turnScore()
    {
        return $this->turnScore;
    }

    /**
     * @return int
     */
    public function savedScore()
    {
        return $this->savedScore;
    }

    /**
     * Calls in dicehand roll. Contains fakeroll for testing purposes. Sets turnscore to 0 if
     * dicehand contains a 1, otherwise sums the score for each dicehand in turn
     * @param int $roll1
     * @param int $roll2
     * @param int $roll3
     */
    public function roll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0)
    {
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

    /**
     * @return DiceHand
     */
    public function diceHand()
    {
        return $this->diceHand;
    }

    /**
     *
     */
    public function saveTurn()
    {
        $this->savedScore += $this->turnScore;
        $this->turnScore = 0;
    }

    /**
     * Returns true if a player gets more than 100 points
     * @return bool
     */
    public function winner()
    {
        $winner = false;
        if ($this->savedScore >= 100) {
            $winner = true;
        } return $winner;
    }
}
