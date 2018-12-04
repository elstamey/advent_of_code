<?php
/**
 * Class Rectangle
 *
 * @package Acme
 * @author  Emily Stamey
 */

namespace Acme;


class Rectangle
{
//    private $id;
    private $leftEdge;
    private $topEdge;
    private $width;
    private $height;

    /**
     * Rectangle constructor.
     *
     * @param int $id
     * @param int $leftEdge
     * @param int $topEdge
     * @param int $width
     * @param int $height
     */
    public function __construct($id, $leftEdge, $topEdge, $width, $height)
    {
//        $this->id = $id;
        $this->leftEdge = $leftEdge;
        $this->topEdge = $topEdge;
        $this->width = $width;
        $this->height = $height;
    }

    public function buildMatrix()
    {
        $matrix = [];
        $matrix[] = [];
        $matrixWidth = $this->leftEdge + $this->width;
        $matrixHeight = $this->topEdge + $this->height;

        for ($i=0; $i < $matrixWidth; $i++) {
            for ($j=0; $j < $matrixHeight; $j++) {
                if (($i < $this->leftEdge) || ($j < $this->topEdge) || ($matrixWidth > $i) || ($j > $matrixHeight) || !isset($matrix[$i][$j])) {
                    $matrix[$i][$j] = '.';
                } else {
                    $matrix[$i][$j] = '#';
                }
            }
        }

        return $matrix;
    }

    public function overlapRectangles($rectangle1, $rectangle2)
    {

    }

    public function buildEmptyMatrix()
    {
        for ($i=0; $i < 1000; $i++) {
            for ($j=0; $j < 1000; $j++) {
                $matrix[$i][$j] = '.';
            }
        }

        return $matrix;
    }

}