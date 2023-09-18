<?php

declare(strict_types=1);

namespace Algorithms;

class ArrayUtils
{
    static function swapValues(array &$array, int $firstIndex, int $secondIndex): void
    {
        $temp = $array[$firstIndex];
        $array[$firstIndex] = $array[$secondIndex];
        $array[$secondIndex] = $temp;
    }
}
