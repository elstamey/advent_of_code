<?php

namespace Acme\Console\Models;


class Bag
{
    public string $color;

    /**
     * @var BagQuantity[]
     */
    private array $contents;

    /**
     * Bag constructor.
     *
     * @param string      $color
     * @param BagQuantity ...$contents
     */
    public function __construct(string $color, BagQuantity... $contents)
    {
        $this->color = $color;
        $this->contents = $contents;
    }

    public function contains(string $color) : bool
    {
        foreach ($this->contents as $bag) {
            if ($bag->color === $color) {
                return true;
            }
        }

        return false;
    }
}