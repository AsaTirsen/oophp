<?php

namespace Asatir\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait2
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $series = [];



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSeries()
    {
        return $this->series;
    }



    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return max($this->series);
    }
}
