<?php

namespace Asti\Dice;

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
    private $values;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new Dice();
            $this->values[$i] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
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
     * Get the sum of all dices if none of the dices show a 1.
     * If one of the dices show a 1 message is returned
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        $values = [];
        foreach ($this->dices as $dice) {
            $values[] = $dice->getLastRoll();
        }
        if (in_array(1, $values) == false) {
            $valuesSum = array_sum($values);
            return $valuesSum;
        } else {
            return "Du slog en etta och förlorade dina poäng";
        }
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $values = [];
        foreach ($this->dices as $dice) {
            $values[] = $dice->getLastRoll();
        }
        $valuesSum = array_sum($values);
        return $valuesSum / count($values);
    }
}
