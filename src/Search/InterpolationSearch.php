<?php

declare(strict_types=1);

namespace Algorithms\Search;

use Algorithms\Comparator\ComparatorInterface;

class InterpolationSearch implements SearchAlgorithmInterface {
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

        $lowestIndex = 0;
        $highestIndex = count($sortedArray) - 1;

        if (
            $this->comparator->isSecondValueLower($sortedArray[$lowestIndex], $searchedValue)
            || $this->comparator->isSecondValueGreater($sortedArray[$highestIndex], $searchedValue)
        ) {
            return SearchAlgorithmInterface::NOT_FOUND;
        }

        while ($lowestIndex <= $highestIndex) {
            $pivotIndex = $this->calculatePivotIndex($sortedArray, $lowestIndex, $highestIndex, $searchedValue);
            $pivotValue = $sortedArray[$pivotIndex];

            if ($this->comparator->areValuesEqual($pivotValue, $searchedValue)) {
                return $pivotIndex;
            }

            if ($this->comparator->isSecondValueGreater($pivotValue, $searchedValue)) {
                $lowestIndex = $pivotIndex + 1;
            } else {
                $highestIndex = $pivotIndex - 1;
            }
        }

        return SearchAlgorithmInterface::NOT_FOUND;
    }

    private function calculatePivotIndex($sortedArray, $lowestIndex, $highestIndex, $searchedValue) {
        return (int)(
            $lowestIndex +
            (
                (
                    ($highestIndex - $lowestIndex)
                    /
                    ($sortedArray[$highestIndex] - $sortedArray[$lowestIndex])
                )
                * ($searchedValue - $sortedArray[$lowestIndex])
            )
        );
    }
}
