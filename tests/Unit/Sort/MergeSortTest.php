<?php

declare(strict_types=1);

namespace Tests\Unit\Sort;

use Algorithms\Comparator\IntegerComparator;
use Algorithms\Sort\MergeSort;

final class MergeSortTest extends AbstractSortTestCase
{
    /**
     * @dataProvider provideSortData
     */
    public function testSort($inputArray, $expectedArray): void
    {
        $sorter = new MergeSort(new IntegerComparator());
        $sorter->sort($inputArray);
        $this->assertEquals($expectedArray, $inputArray);
    }
}
