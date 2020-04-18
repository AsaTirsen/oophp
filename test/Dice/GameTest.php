<?php

namespace Asatir\Dice;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testPlayGame()
    {
        // init
        $game = new Game();
        $this->assertEquals(0, $game->humanPlayer()->turnScore());
        $this->assertEquals(0, $game->humanPlayer()->savedScore());
        $this->assertEquals(0, $game->computerPlayer()->turnScore());
        $this->assertEquals(0, $game->computerPlayer()->savedScore());

        // first roll
        $game->humanRoll(3, 4, 5);
        $this->assertEquals(12, $game->humanPlayer()->turnScore());
        $this->assertEquals(0, $game->humanPlayer()->savedScore());

        // second roll
        $game->humanRoll(2, 3, 6);
        $this->assertEquals(23, $game->humanPlayer()->turnScore());
        $this->assertEquals(0, $game->humanPlayer()->savedScore());

        // save score
        $game->humanSave();
        $this->assertEquals(0, $game->humanPlayer()->turnScore());
        $this->assertEquals(23, $game->humanPlayer()->savedScore());

        // computer turn
        $game->computerRoll(5, 6, 6);
        $this->assertEquals(0, $game->computerPlayer()->turnScore());
        $this->assertEquals(17, $game->computerPlayer()->savedScore());

        // human gets 1
        $game->humanRoll(1, 4, 5);
        $this->assertEquals(0, $game->humanPlayer()->turnScore());
        $this->assertEquals(23, $game->humanPlayer()->savedScore());

        // computer gets 1
        $game->computerRoll(1, 6, 6);
        $this->assertEquals(0, $game->computerPlayer()->turnScore());
        $this->assertEquals(17, $game->computerPlayer()->savedScore());
    }
}
