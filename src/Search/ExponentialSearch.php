<?php

declare(strict_types=1);

namespace Algorithms\Search;

use Algorithms\Comparator\ComparatorInterface;

class ExponentialSearch implements SearchAlgorithmInterface {
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function findIndexOfValue(array $sortedArray, int $searchedValue): int {
        if (array_is_list($sortedArray) === false ) {
            throw new \UnexpectedValueException('Array isn\'t a list.');
        }

        $pivot = 1;
        $arraySize = count($sortedArray);

        while ($pivot < $arraySize && $sortedArray[$pivot] <= $searchedValue) {
            $pivot *= 2;
        }

        $startIndexOfSearchedRange = (int)($pivot / 2);
        $endIndexOfSearchedRange = $pivot < $arraySize ? $pivot : $arraySize - 1;

        $foundIndex = $this->findByBinarySearch(
            array_slice($sortedArray, $startIndexOfSearchedRange, $endIndexOfSearchedRange - $startIndexOfSearchedRange),
            $searchedValue
        );

        return ($foundIndex === SearchAlgorithmInterface::NOT_FOUND)
            ? SearchAlgorithmInterface::NOT_FOUND
            : ($foundIndex + $startIndexOfSearchedRange);
    }

    private function findByBinarySearch(array $sortedArray, int $searchedValue): int {
        return (new BinarySearch($this->comparator))->findIndexOfValue($sortedArray, $searchedValue);
    }
}
