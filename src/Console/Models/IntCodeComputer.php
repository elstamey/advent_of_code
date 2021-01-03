<?php


namespace Acme\Console\Models;


class IntCodeComputer
{

    /**
     * @var
     */
    private $opCode;
    private $firstValueAddress;
    private $secondValueAddress;
    private $saveResultAddress;
    private $result;
    private $inputArray;
    private $numberOfInstructionValues;

    /**
     * IntCode constructor.
     * @param $inputArray
     */
    public function __construct($inputArray, $numberOfInstructionValues)
    {
        $this->inputArray = $inputArray;
        $this->numberOfInstructionValues = $numberOfInstructionValues;
    }


    /**
     * @param int $startAddress
     * @return int[]
     */
    public function readOpCodes(int $startAddress)
    {
        $parameter = $startAddress + 1;
        return [
            $this->inputArray[$startAddress],
            $this->inputArray[$parameter],
            $this->inputArray[$parameter + 1],
            $this->inputArray[$parameter + 2]
        ];
    }

    public function initializeInputArray($noun=12, $verb=2)
    {
        $this->inputArray[1] = $noun;
        $this->inputArray[2] = $verb;
    }

    public function compute()
    {
        $count = count($this->inputArray);
        print("There are " . (string)$count . " instructions in this program\n");

        for ($instructionPointer=0;
            ((($instructionPointer + $this->numberOfInstructionValues +1) < $count)
                && ($this->inputArray[$instructionPointer] !== 99));
            $instructionPointer+=$this->numberOfInstructionValues + 1) {

            print ($instructionPointer . "\n");
            $this->printOpCodes($instructionPointer);
            list($opCode, $parameterOne, $parameterTwo, $parameterThree) = $this->readOpCodes($instructionPointer);

            $this->handleOpCodes($opCode, $parameterOne,  $parameterTwo, $parameterThree);
            print ($this->inputArray[$parameterThree] . "\n");

            $this->printOpCodes($parameterThree-3);
            print("-----\n");
        }

        return $this->inputArray[0];
    }

    private function handleOpCodes($opCode, $valueOneAddress, $valueTwoAddress, $resultAddress)
    {
        switch ($opCode) {
            case 1:
                print ("add\n");
                $this->inputArray[$resultAddress] = $this->handleAdd($valueOneAddress, $valueTwoAddress);
                break;
            case 2:
                print("multiply\n");
                $this->inputArray[$resultAddress] = $this->handleMultiply($valueOneAddress, $valueTwoAddress);
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

    private function handleAdd($valueOneAddress, $valueTwoAddress)
    {
        return ($this->inputArray[$valueOneAddress] + $this->inputArray[$valueTwoAddress]);
    }


    private function handleMultiply($valueOneAddress, $valueTwoAddress)
    {
        return ($this->inputArray[$valueOneAddress] * $this->inputArray[$valueTwoAddress]);
    }
}