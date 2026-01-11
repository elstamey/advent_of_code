<?php

namespace Acme\Console\Models;

class Dial {

    private array $face;
    private int $pointer;

    public function __construct(int $lowestFaceNumber, int $highestFaceNumber)
    {
        $this->face = range($lowestFaceNumber,$highestFaceNumber, 1);
        $this->pointer = $lowestFaceNumber;
    }

    public function getFace(): array
    {
        return $this->face;
    }

    /**
     * @return int
     */
    public function getPointer(): int
    {
        return $this->pointer;
    }

    /**
     * @param int $pointerValue
     */
    public function setPointerAtFaceValue(int $pointerValue): void
    {
        $this->pointer = array_search($pointerValue, $this->face);
    }

    public function getFaceValue(): int
    {
        return $this->face[$this->pointer];
    }
    public function movePointer(string $movementDirection)
    {
        $direction = substr($movementDirection, 0, 1);
        $amount = intval( substr($movementDirection, 1) );

        switch ($direction) {
            case 'R':
                $this->increasePointer($amount);
                break;
            case 'L':
                $this->decreasePointer($amount);
                break;
        }
    }

    public function increasePointer( int $amount ): void
    {
        $numbersOnDial = count($this->face);
        $currentPointer = $this->pointer;

        while ( $amount > $numbersOnDial) {
            $amount -= $numbersOnDial;
        }

        if ( ($currentPointer + $amount) >= $numbersOnDial) {
            $this->pointer = $currentPointer + $amount - $numbersOnDial;
        } else {
            $this->pointer = $currentPointer + $amount;
        }
    }

    private function decreasePointer(int $amount): void
    {
        $numbersOnDial = count($this->face);
        $currentPointer = $this->pointer;

        while ( $amount > $numbersOnDial) {
            $amount -= $numbersOnDial;
        }

        if ( ($currentPointer - $amount) < 0) {
            $this->pointer = $currentPointer - $amount + $numbersOnDial;
        } else {
            $this->pointer = $currentPointer - $amount;
        }
    }
}