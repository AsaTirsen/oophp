<?php

namespace Asatir\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices Array consisting of dices.
     * @var int $values Array consisting of last roll of the dices.
     */
    private $dices;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 3)
    {
        $this->dices = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    /**
     * Roll all dices save their value.
     * @return void.
     */
    public function roll()
    {
        foreach ($this->dices as $dice) {
            $dice->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        $values = [];
        foreach ($this->dices as $dice) {
            $values[] = $dice->getLastRoll();
        }
        return $values;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        $values = [];
        foreach ($this->dices as $dice) {
            $values[] = $dice->getLastRoll();
            $valuesSum = array_sum($values);
        }
        return $valuesSum;
    }


    public function diceRepresentation()
    {
        foreach ($this->dices as $dice) {
            $representation = $dice->graphic();
        }
        return $representation;
    }

    public function checkIfOne()
    {
        $nonSavableScore = false;
        foreach ($this->dices as $dice) {
            if ($dice->getLastRoll() == 1) {
                $nonSavableScore = true;
            }
        }
        return $nonSavableScore;
    }

    /**
     * Override the dice roll for testing.
     * @param int $diceIndex
     * @param int $roll
     */
    public function fakeRoll(int $diceIndex, int $roll)
    {
        $this->dices[$diceIndex]->fakeRoll($roll);
    }
}
