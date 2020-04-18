<?php

namespace Asatir\Dice;

/**
 * class Game that runs initiates two players and keeps track of who's turn it is
 **/
class Game
{
    private $humanPlayer;
    private $computerPlayer;
    private $activePlayer;

    public function __construct()
    {
        $this->humanPlayer = new Player();
        $this->computerPlayer = new Player();
    }

    public function humanPlayer() {
        return $this->humanPlayer;
    }

    public function computerPlayer() {
        return $this->computerPlayer;
    }

    public function humanSave() {
        $this->humanPlayer->saveTurn();
    }

    public function humanRoll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0)
    {
        $this->humanPlayer->roll($roll1, $roll2, $roll3);
    }

    public function computerRoll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0)
    {
        $this->computerPlayer->roll($roll1, $roll2, $roll3);
        $this->computerPlayer->saveTurn();
    }
}
