<?php


namespace Acme\Console\Models;


class BagQuantity
{
    public string $color;
    public int $quantity;

    /**
     * BagQuantity constructor.
     *
     * @param string $color
     * @param int    $quantity
     */
    public function __construct(string $color, int $quantity)
    {
        $this->color = $color;
        $this->quantity = $quantity;
    }


}