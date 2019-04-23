<?php
/**
 * Created by PhpStorm.
 * User: asa
 * Date: 23/4/19
 * Time: 11:34 AM
 */

class Dice {

    public $diceNumber;
    public $noRolls;



    public function __construct()
    {
        $this->diceRolls();
    }

    public function diceRolls() {
        $this->diceNumber= rand(1, 6);
        return $this->diceNumber;
    }
}