<?php

namespace Asatir\Dice;

use PHPUnit\Framework\TestCase;

class HistogramTest extends TestCase
{
    private $histogram;
    private $diceHistogram;

    protected function setUp(): void
    {
        $this->histogram = new Histogram();
        $this->diceHistogram = new DiceHistogram2();
    }

    public function testGetSeries()
    {
        $this->diceHistogram->fakeRoll(3);
        $this->histogram->injectData($this->diceHistogram);
        $this->assertContains(3, $this->histogram->getSeries());
    }
    public function testGetAsAsterisk()
    {
        $this->diceHistogram->fakeRoll(3);
        $this->histogram->injectData($this->diceHistogram);
        $this->assertStringContainsString("*", $this->histogram->getAsAsterisk());
    }

    public function testGetHistogramMin()
    {
        $this->histogram->injectData($this->diceHistogram);
        $this->assertEquals(1, $this->diceHistogram->getHistogramMin());
    }

    public function testGetHistogramMax()
    {
        $this->histogram->injectData($this->diceHistogram);
        $this->assertEquals(6, $this->diceHistogram->getHistogramMax());
    }
}
