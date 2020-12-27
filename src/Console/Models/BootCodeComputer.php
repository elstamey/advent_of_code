<?php


namespace Acme\Console\Models;


class BootCodeComputer
{
    /**
     * @var int
     */
    private int $accumulator;

    /**
     * @var int
     */
    private int $position;

    /**
     * @var int[]
     */
    private array $visited = [];

    /**
     * BootCodeComputer constructor.
     *
     */
    public function __construct()
    {
        $this->accumulator = 0;
        $this->position = 0;
    }

    public function accumulate(int $accAmount) : void
    {
        $this->accumulator += $accAmount;
    }

    public function makeJump(int $jumpAmount) : void
    {
        $this->position += $jumpAmount;
    }

    public function noOp() : void
    {
        $this->makeJump(1);
    }

    public function hasBeenVisited(string $instruction, int $amount) : bool
    {
        if ($instruction === 'jmp') {
            $newPosition = $this->position + $amount;
        } else {
            $newPosition = $this->position + 1;
        }

        return in_array($newPosition, $this->visited);
    }

    public function getAccumulator() : int
    {
        return $this->accumulator;
    }

    public function getPosition() : int
    {
        return $this->position;
    }

    public function recordVisit() : void
    {
        $this->visited[] = $this->position;
    }

    public function hasVisitedPrevious(int $currentPosition) : bool
    {
        return in_array(($currentPosition-1), $this->visited);
    }
}