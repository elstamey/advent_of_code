<?php


namespace Acme\Console\Models;


use SplQueue;

class Rules
{
    /**
     * @var Bag[]
     */
    private array $bags;


    public function createFromString(string $ruleString) : void
    {
        if (empty($ruleString)) {
            return;
        }

        [$leftSide, $rightSide] = preg_split('/ contain /', $ruleString);
        preg_match("/(?P<color>\w+ \w+) bag/", $leftSide, $matches);
        $color = $matches['color'];

        if (strpos($rightSide, 'no other bag') !== false) {
            $bagContents = [];
        } else {
            $contents = explode(', ', $rightSide);
            /** @var BagQuantity[] $bagContents */
            $bagContents = array_map(function ($quantityBagDescription) {
                preg_match("/(?P<qty>\d+) (?P<color>\w+ \w+) bag/", $quantityBagDescription, $matches);
                return new BagQuantity($matches['color'], intval($matches['qty']));
            }, $contents);
        }

        $this->bags[$color] = new Bag($color, ...$bagContents);
    }

    /**
     * @param string $bagColor
     *
     * @return string[]
     */
    public function findBagsContaining(string $bagColor) : array
    {
        $bagsContaining = [];
        $queue = new SplQueue();

        $queue->enqueue($bagColor);
        while (true) {
            try {
                $color = $queue->dequeue();

            } catch (\RuntimeException $e) {
                break;
            }
            if (in_array($color, $bagsContaining)) {
                continue;
            }

            $bagsContaining[] = $color;

            $bagsWithColor = $this->findBagsHolding($color);
            foreach ($bagsWithColor as $b) {
                $queue->enqueue($b);
            }
        }

        return $bagsContaining;
    }

    /**
     * @param string $color
     *
     * @return string[]
     */
    private function findBagsHolding(string $color) : array
    {
        $bagsHolding = [];

        foreach ($this->bags as $bag) {
            if ($bag->contains($color)) {
                $bagsHolding[] = $bag->color;
            }
        }

        return $bagsHolding;
    }

    public function countBagsInside(string $color) : int
    {
        $bagsInside = $this->findBagsInside($color);
        $bagCount = 0;

        if (count($bagsInside) === 0) {
            return 0;
        }

        foreach ($bagsInside as $bagQuantity) {
            $bagCount += $bagQuantity->quantity + ($bagQuantity->quantity * $this->countBagsInside($bagQuantity->color));
        }

        return $bagCount;
    }

    /**
     * @param string $color
     *
     * @return BagQuantity[]
     */
    private function findBagsInside(string $color) : array
    {
        return $this->bags[$color]->getContents();
    }
}