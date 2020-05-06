<?php

namespace Asatir\Dice;

/**
 * class Game that runs initiates two players and keeps track of who's turn it is
 **/
class Game
{
    /**
     * @var Player
     */
    private $humanPlayer;
    private $computerPlayer;
    private $humanTurn;

    /**
     * Game constructor.
     * Takes private members and instantiates them to class Player.
     * Sets humanTurn to true
     */
    public function __construct()
    {
        $this->humanPlayer = new Player();
        $this->computerPlayer = new Player();
        $this->humanTurn = true;
    }

//    /**
//     * @return Histogram
//     */
//    public function histogram(): Histogram
//    {
//        return $this->histogram;
//    }

    /**
     * @return Player
     */
    public function humanPlayer()
    {
        return $this->humanPlayer;
    }

    /**
     * @return Player
     */
    public function computerPlayer()
    {
        return $this->computerPlayer;
    }

    /**
     * if save command is given in dice view, the turn is saved
     * and the computer is given the turn
     * @return void
     */
    public function humanSave()
    {
        $this->humanPlayer->saveTurn();
        $this->humanTurn = false;
    }

    /**
     * Human rolls a hand of dice. If she gets a one, humansave() is called
     *  so the turn can go to computer
     * @param int $roll1
     * @param int $roll2
     * @param int $roll3
     * @return void
     */
    public function humanRoll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0)
    {
        $this->humanPlayer->roll($roll1, $roll2, $roll3);
        if ($this->humanPlayer->diceHand()->checkIfOne()) {
            $this->humanTurn = false;
        }
    }

    /**
     * Computer rolls hand of dice. Turn automatically saved after 1 roll. Turn given to human.
     * @param int $roll1
     * @param int $roll2
     * @param int $roll3
     * @return void
     */
    public function computerRoll(int $roll1 = 0, int $roll2 = 0, int $roll3 = 0)
    {
        $computerScore = $this->computerPlayer->savedScore() + $this->computerPlayer->turnScore();
        $humanScore = $this->humanPlayer->savedScore();
        $checkIfOne = $this->computerPlayer->diceHand()->checkIfOne();
        $this->computerPlayer->roll($roll1, $roll2, $roll3);
        if ($this->scoreComparison($computerScore, $humanScore) && !$checkIfOne) {
            $this->computerPlayer->roll($roll1, $roll2, $roll3);
        }
        $this->computerPlayer->saveTurn();
        $this->humanTurn = true;
    }

    public function scoreComparison($computerScore, $humanScore)
    {
        $underDog = false;
        if ((100-$computerScore > 30) && (100-$humanScore < 30)) {
            $underDog = true;
        } elseif ($computerScore / $humanScore < 0.7) {
            $underDog = true;
        }
        return $underDog;
    }

    public function fakeHumanSavedTurn(int $score)
    {
        return $score;
    }

    public function fakeComputerTurnScore(int $score)
    {
        return $score;
    }

    /**
     * @return bool
     */
    public function humanTurn()
    {
        return $this->humanTurn;
    }
}
