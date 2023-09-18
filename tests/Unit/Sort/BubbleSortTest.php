<?php

declare(strict_types=1);

namespace Tests\Unit\Sort;

use Algorithms\Comparator\IntegerComparator;
use Algorithms\Sort\BubbleSort;

final class BubbleSortTest extends AbstractSortTestCase
{
    /**
     * @dataProvider provideSortData
     */
    public function testSort($inputArray, $expectedArray): void
    {
        $sorter = new BubbleSort(new IntegerComparator());
        $sorter->sort($inputArray);
        $this->assertEquals($expectedArray, $inputArray);
    }
}
