<?php

declare(strict_types=1);

namespace Algorithms\Search;

use Algorithms\Comparator\ComparatorInterface;

class BinarySearch implements SearchAlgorithmInterface {
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function findIndexOfValue(array $sortedArray, int $searchedValue): int {
        if (array_is_list($sortedArray) === false ) {
            throw new \UnexpectedValueException('Array isn\'t a list.');
        }

        $startOfSearchedRange = 0;
        $endOfSearchedRange = count($sortedArray) - 1;

        while ($startOfSearchedRange <= $endOfSearchedRange) {
            $halfOfRange = $startOfSearchedRange + (int)floor(($endOfSearchedRange - $startOfSearchedRange) / 2);

            if ($this->comparator->areValuesEqual($sortedArray[$halfOfRange], $searchedValue)) {
                return $halfOfRange;
            }

            if ($this->comparator->isSecondValueGreater($sortedArray[$halfOfRange], $searchedValue)) {
                $startOfSearchedRange = $halfOfRange + 1;
                continue;
            }

            $endOfSearchedRange = $halfOfRange - 1;
        }

        return SearchAlgorithmInterface::NOT_FOUND;
    }
}
