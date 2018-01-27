<?php
/**
 * Class Program
 *
 * @author  Emily Stamey
 */

class Program
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var Program[]
     */
    protected $heldPrograms;

    /**
     * Program constructor.
     *
     * @param $name
     * @param $weight
     * @param $heldPrograms
     */
    public function __construct($name, $weight, $heldPrograms)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->heldPrograms = $heldPrograms;
    }


    public function heldBy()
    {

    }
}