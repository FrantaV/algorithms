<?php

namespace Algorithms\Sort;

use Algorithms\Comparator\ComparatorInterface;

// Time Complexity
// * Best: Ω(n)
// * Worst: O(nlog n)
// * Average: θ(nlog n)
// * Space Complexity: O(n)
// * Stability: Yes
//
// Advantages of Tim Sort
// *  It is a stable sorting technique.
// *  Deals with real-world data
// *  The worst-case complexity is O(nlog n)
//
// Disadvantages of Tim Sort
// *  There are no such disadvantages of TimSort as it is an efficient sorting algorithm.

class TimSort implements SortInterface {
    public const MIN_MERGE_SIZE = 32;

    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void {
        $arraySize = count($arrayToSort);
        $runLength = $this->calculateRunLength($arraySize);
        $arrayLastIndex = $arraySize - 1;

        for ($startIndex = 0; $startIndex < $arraySize; $startIndex += $runLength) {
            $endIndex = min($arrayLastIndex, $startIndex + $runLength - 1);
            $this->insertSort($arrayToSort, $startIndex, $endIndex);
        }

        $mergeSize = $runLength;
        while ($mergeSize < $arraySize) {
            for ($left = 0; $left < $arraySize; $left += $mergeSize * 2) {
                $middle = $left + $mergeSize - 1;
                $right = min($arrayLastIndex, $left + ($mergeSize * 2) - 1);

                if ($middle < $right) {
                    $this->mergeSort($arrayToSort, $left, $middle, $right);
                }
            }
            $mergeSize *= 2;
        }
    }

    private function calculateRunLength($arraySize): int {
        $remainder = 0;
        $runLength = $arraySize;
        while ($runLength > self::MIN_MERGE_SIZE) {
            if ($this->isOdd($runLength)) {
                $remainder = 1;
            }
            $runLength = (int)floor($runLength / 2);
        }
        return $runLength - $remainder;
    }

    private function isOdd(int $number): bool {
        return $number % 2 !== 0;
    }

    private function insertSort(array &$arrayToSort, $startIndex, $endIndex): void {
        for ($currentIndex = $startIndex + 1; $currentIndex <= $endIndex; $currentIndex++) {
            $currentValue = $arrayToSort[$currentIndex];
            $previousIndex = $currentIndex - 1;
            while (
                $previousIndex >= $startIndex
                && $this->comparator->isSecondValueGreater($currentValue, $arrayToSort[$previousIndex])
            ) {
                $arrayToSort[$previousIndex + 1] = $arrayToSort[$previousIndex];
                $previousIndex--;
            }
            $arrayToSort[$previousIndex + 1] = $currentValue;
        }
    }

    private function mergeSort(array &$resultArray, $startIndex, $middleIndex, $endIndex): void {
        $leftArray = array_slice($resultArray, $startIndex, $middleIndex - $startIndex + 1);
        $rightArray = array_slice($resultArray, $middleIndex + 1, $endIndex - $middleIndex);

        $leftIndex = 0;
        $leftArraySize = count($leftArray);
        $rightIndex = 0;
        $rightArraySize = count($rightArray);
        $resultIndex = $startIndex;

        while ($leftIndex < $leftArraySize && $rightIndex < $rightArraySize) {
            if ($this->comparator->isSecondValueGreater($leftArray[$leftIndex], $rightArray[$rightIndex])) {
                $resultArray[$resultIndex++] = $leftArray[$leftIndex++];
                continue;
            }

            $resultArray[$resultIndex++] = $rightArray[$rightIndex++];
        }

        $this->appendRemainingValues($resultArray, $resultIndex, $leftArray, $leftIndex);
        $this->appendRemainingValues($resultArray, $resultIndex, $rightArray, $rightIndex);
    }

    private function appendRemainingValues(array &$arrayResult, int &$resultIndex, array $array, int $index): void {
        $arraySize = count($array);
        while ($index < $arraySize) {
            $arrayResult[$resultIndex++] = $array[$index++];
        }
    }
}
