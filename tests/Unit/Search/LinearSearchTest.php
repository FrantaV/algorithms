<?php

declare(strict_types=1);

namespace Tests\Unit\Search;

use Algorithms\Comparator\IntegerComparator;
use Algorithms\Search\LinearSearch;

final class LinearSearchTest extends AbstractSearchTestCase {
    /**
     * @dataProvider provideSearchData
     */
    public function testSort($sortedArray, $searchedValue, $expectedResult): void {
        $searcher = new LinearSearch(new IntegerComparator());
        $searchedIndex = $searcher->findIndexOfValue($sortedArray, $searchedValue);
        $this->assertEquals($expectedResult, $searchedIndex);
    }

    public function testInvalidArrayTypeSort(): void {
        $searcher = new LinearSearch(new IntegerComparator());
        $searchedValue = 1;
        $this->expectException(\UnexpectedValueException::class);
        $searchedIndex = $searcher->findIndexOfValue($this->getInvalidListTypeArray(), $searchedValue);
    }
}
