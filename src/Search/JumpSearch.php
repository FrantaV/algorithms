<?php

declare(strict_types=1);

namespace Algorithms\Search;

use Algorithms\Comparator\ComparatorInterface;

class JumpSearch implements SearchAlgorithmInterface {
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function findIndexOfValue(array $sortedArray, int $searchedValue): int {
        if (array_is_list($sortedArray) === false ) {
            throw new \UnexpectedValueException('Array isn\'t a list.');
        }

        if ($sortedArray === []) {
            return SearchAlgorithmInterface::NOT_FOUND;
        }

        $sizeOfArray = count($sortedArray);
        $startIndexOfSearchedRange = 0;
        $jumpLength = (int)sqrt($sizeOfArray);
        $endIndexOfSearchedRange = $jumpLength;

        while ($endIndexOfSearchedRange < $sizeOfArray && $sortedArray[$endIndexOfSearchedRange] <= $searchedValue) {
            $startIndexOfSearchedRange = $endIndexOfSearchedRange;
            $endIndexOfSearchedRange += $jumpLength;
        }

        if ($endIndexOfSearchedRange > $sizeOfArray) {
            $endIndexOfSearchedRange = $sizeOfArray;
        }

        $foundIndex = $this->findByLinearSearch(
            array_slice($sortedArray, $startIndexOfSearchedRange, $endIndexOfSearchedRange - $startIndexOfSearchedRange),
            $searchedValue
        );

        return ($foundIndex === SearchAlgorithmInterface::NOT_FOUND)
            ? SearchAlgorithmInterface::NOT_FOUND
            : ($foundIndex + $startIndexOfSearchedRange);
    }

    private function findByLinearSearch(array $sortedArray, int $searchedValue): int {
        return (new LinearSearch($this->comparator))->findIndexOfValue($sortedArray, $searchedValue);
    }
}
