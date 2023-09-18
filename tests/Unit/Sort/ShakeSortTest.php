<?php

declare(strict_types=1);

namespace Tests\Unit\Sort;

use Algorithms\Comparator\IntegerComparator;
use Algorithms\Sort\ShakerSort;

final class ShakeSortTest extends AbstractSortTestCase
{
    /**
     * @dataProvider provideSortData
     */
    public function testSort($inputArray, $expectedArray): void
    {
        $sorter = new ShakerSort(new IntegerComparator());
        $sorter->sort($inputArray);
        $this->assertEquals($expectedArray, $inputArray);
    }
}
