<?php

namespace Asatir\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $series  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $series = [];
    private $min;
    private $max;

    public function injectData(HistogramInterface $object)
    {
        // TODO sum up
        foreach($object->getHistogramSeries() as $value) {
            array_push($this->series, $value);
        }
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSeries()
    {
        return $this->series;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsAsterisk()
    {
        $series = $this->getSeries();
        $asterisk = '*';
        $rangeArray = range($this->min, $this->max);
        $histogram = [];

        $count = array_count_values($series);

        foreach ($count as $key => $value)
            array_push($histogram, $key . ': ' . str_repeat($asterisk, $value));
        if ($this->min !== null && $this->max !== null) {
            foreach ($rangeArray as $val) {
                if (!in_array($val, $histogram)) {
                    array_push($histogram, $val . ": ");
                }
            }
        }
        asort($histogram);;
        return implode("<br>", $histogram);
    }
}
