<?php
namespace Asatir\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class GuessB
{
    /**
     * @var int $number The current secret number.
     * @var int $tries Number of tries a guess has been made.
     */
    private $number = null;
    private $tries = 6;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     * @param int number
     * @param int tries
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            $number = rand(1, 100);
        }
        $this->number = $number;
    }

    /**
     * Randomize secret number between 1 and 100 to initiate new game
     * @ return void
     */
    public function random(): void
    {
        $this->number = rand(1, 100);
    }


    /**
     * Get number of tries left
     *
     * @return int as number of tries made
     */
    public function tries(): int
    {
        return $this->tries;
    }


    /**
     * Get the secret number
     *
     * @return int as the secret number
     */
    public function number(): int
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low, too high or if no guesses remain
     *
     * @param int $guess the guessed number
     *
     * @throws GuessException when guessed number is out of bounds
     *
     * @return string to show the status of the guess made
     */

    public function makeGuess(int $guess): string
    {
        if ($guess < 1 || $guess > 100) {
            throw new GuessException("Number must be between 1 and 100");
        }
        $this->tries--;

        if ($guess === $this->number) {
            $res = "Correct";
        } elseif ($guess > $this->number) {
            $res = "Too high";
        } else {
            $res = "Too low";
        }
        return $res;
    }
}
