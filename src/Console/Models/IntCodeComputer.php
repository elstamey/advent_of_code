<?php


namespace Acme\Console\Models;


class IntCodeComputer
{

    /**
     * @var
     */
    private $opCode;
    private $firstValuePosition;
    private $secondValuePosition;
    private $saveResultPosition;
    private $result;
    private $inputArray;

    /**
     * IntCode constructor.
     * @param $inputArray
     */
    public function __construct($inputArray)
    {
        $this->inputArray = $inputArray;
        $this->initializeInputArray();
    }


    /**
     * @param int $startPosition
     * @return int[]
     */
    public function readOpCodes($startPosition)
    {
        return [
            $this->inputArray[$startPosition],
            $this->inputArray[$startPosition +1],
            $this->inputArray[$startPosition +2],
            $this->inputArray[$startPosition +3]
        ];
    }

    private function initializeInputArray()
    {
        $this->inputArray[1] = 12;
        $this->inputArray[2] = 2;
    }

    public function compute()
    {
        var_dump($this->inputArray);

        $count = count($this->inputArray);

        for ($i=0; (($i < $count) && ($this->inputArray[$i] !== 99)); $i=$i+4) {

            print ($i . "\n");
            $this->printOpCodes($i);
            list($opCode, $valueOnePosition, $valueTwoPosition, $resultPosition) = $this->readOpCodes($i);

            $this->handleOpCodes($opCode, $valueOnePosition,  $valueTwoPosition, $resultPosition);
            print ($this->inputArray[$resultPosition] . "\n");

            $this->printOpCodes($resultPosition-3);
            print("-----\n");
        }

        return $this->inputArray[0];
    }

    private function handleOpCodes($opCode, $valueOnePosition, $valueTwoPosition, $resultPosition)
    {
        switch ($opCode) {
            case 1:
                print ("add\n");
                $this->inputArray[$resultPosition] = $this->inputArray[$valueOnePosition] + $this->inputArray[$valueTwoPosition];
                break;
            case 2:
                print("multiply\n");
                $this->inputArray[$resultPosition] = $this->inputArray[$valueOnePosition] * $this->inputArray[$valueTwoPosition];
                break;
        }
    }


    private function printOpCodes($i)
    {
        if (($i >= 0) && (($i+3) < count($this->inputArray))) {
            print ( $this->inputArray[$i] . " ");
            print ( $this->inputArray[$i+1] . " ");
            print ( $this->inputArray[$i+2] . " ");
            print ( $this->inputArray[$i+3] . " \n");
        }
    }
}