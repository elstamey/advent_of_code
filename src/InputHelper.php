<?php
/**
 * Class InputHandler
 *
 * @package Acme
 * @author  Emily Stamey
 */

namespace Acme;


class InputHelper
{
    /**
     * @param $input
     *
     * @return array
     */
    public static function getRows($input)
    {
        return preg_split('/\n/', $input, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function splitByLinesToArrayOfIntval($input)
    {
        return array_map('intval', self::getRows($input));
    }

    public static function splitRowBySpace($row)
    {
        return preg_split('/\s/', $row, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function splitRowByComma($row)
    {
        return preg_split('/\,/', $row, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function splitRowByX($row)
    {
        return preg_split('/x/', $row, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function splitCharacters($row)
    {
        return preg_split('//', $row, -1,  PREG_SPLIT_NO_EMPTY);
    }

}