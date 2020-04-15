<?php
namespace Asatir\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number The current secret number.
     * @var int $tries Number of tries a guess_orig has been made.
     */
    public $number;
    public $tries;
    public $lastResult;
    public $lastGuess;


    /**
     * Set the number of tries.
     *
     * @param int $tries The number of tries.
     *
     * @return void
     */
    public function setTries(int $tries)
    {
        $this->tries = $tries;
    }


    /**
     * Get the number of tries used up.
     *
     * @return int as number of tries.
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     */
    public function __construct()
    {
        $this->init();
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function init()
    {
        $this->number = rand(1, 100);
        $this->tries = 0;
        $this->lastResult = null;
        $this->lastGuess = null;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function getNumber()
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     */
    public function makeGuess(int $number)
    {
        if ($number < 0 || $number > 100) {
            throw new GuessException("Number must be between 1-100.");
        }

        $this->lastGuess = $number;

        $this->setTries($this->getTries() + 1);

        if ($this->getTries() >= 6) {
            $this->lastResult = "your last guess!";
        } else {
            if ($this->number === $number) {
                $this->lastResult = "Correct!!";
            } elseif ($this->number > $number) {
                $this->lastResult = "Too low!!";
            } else {
                $this->lastResult = "Too high!!";
            }
        }
    }
}
