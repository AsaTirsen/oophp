<?php

namespace Asatir\Dice;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private $game;
    protected function setUp(): void
    {
        $this->game = new Game();
    }


    public function testPlayGame()
    {
        // init
        $this->assertEquals(0, $this->game->humanPlayer()->turnScore());
        $this->assertEquals(0, $this->game->humanPlayer()->savedScore());
        $this->assertEquals(0, $this->game->computerPlayer()->turnScore());
        $this->assertEquals(0, $this->game->computerPlayer()->savedScore());

        // first roll
        $this->game->humanRoll(3, 4, 5);
        $this->assertEquals(12, $this->game->humanPlayer()->turnScore());
        $this->assertEquals(0, $this->game->humanPlayer()->savedScore());

        // second roll
        $this->game->humanRoll(2, 3, 6);
        $this->assertEquals(23, $this->game->humanPlayer()->turnScore());
        $this->assertEquals(0, $this->game->humanPlayer()->savedScore());
        $this->assertEquals(true, $this->game->humanTurn());
        $this->assertEquals(false, $this->game->humanPlayer()->diceHand()->checkIfOne());

        // save score
        $this->game->humanSave();
        $this->assertEquals(0, $this->game->humanPlayer()->turnScore());
        $this->assertEquals(23, $this->game->humanPlayer()->savedScore());
        $this->assertEquals(false, $this->game->humanTurn());
        $this->assertEquals(false, $this->game->humanPlayer()->diceHand()->checkIfOne());

        // computer turn
        $this->game->computerRoll(5, 6, 6);
        $this->assertEquals(0, $this->game->computerPlayer()->turnScore());
        $this->assertEquals(34, $this->game->computerPlayer()->savedScore());
        $this->assertEquals(true, $this->game->humanTurn());


        // human gets 1
        $this->game->humanRoll(1, 4, 5);
        $this->assertEquals(0, $this->game->humanPlayer()->turnScore());
        $this->assertEquals(23, $this->game->humanPlayer()->savedScore());
        $this->assertEquals(true, $this->game->humanPlayer()->diceHand()->checkIfOne());

        // computer gets 1
        $this->game->computerRoll(1, 6, 6);
        $this->assertEquals(0, $this->game->computerPlayer()->turnScore());
        $this->assertEquals(34, $this->game->computerPlayer()->savedScore());
    }

    public function testScoreComparison()
    {
        $this->assertTrue($this->game->scoreComparison(
            $this->game->fakeComputerTurnScore(50),
            $this->game->fakeHumanSavedTurn(75)
        ));
        $this->assertTrue($this->game->scoreComparison(
            $this->game->fakeComputerTurnScore(40),
            $this->game->fakeHumanSavedTurn(80)
        ));
        $this->assertFalse($this->game->scoreComparison(
            $this->game->fakeComputerTurnScore(75),
            $this->game->fakeHumanSavedTurn(50)
        ));
        $this->assertFalse($this->game->scoreComparison(
            $this->game->fakeComputerTurnScore(75),
            $this->game->fakeHumanSavedTurn(70)
        ));
    }
}
