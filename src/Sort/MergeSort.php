<?php

declare(strict_types=1);

namespace Algorithms\Sort;

// Time Complexity
// * Best: Ω(nlog n)
// * Worst: O(nlog n)
// * Average: θ(nlog n)
// * Space Complexity: O(n)
// * Stability: Yes
//
// Advantages of Merge Sort
// * Works well for larger lists*
//       * Has a consistent running time
// * Preserves the order of equal elements
// * Handles slow-to-access sequential data efficiently
//
// Disadvantages of Merge Sort
// * Is slower for smaller lists compared to other sorting algorithms
// * Takes up more space
// * Requires additional memory for sorting, apart from the given array

use Algorithms\Comparator\ComparatorInterface;

class MergeSort implements SortInterface
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $arraySize = count($arrayToSort);
        if ($arraySize <= 1) {
            return;
        }

        $middle = (int)($arraySize / 2);
        $left = array_slice($arrayToSort, 0, $middle);
        $right = array_slice($arrayToSort, $middle);

        $this->sort($left);
        $this->sort($right);

        $this->merge($arrayToSort, $left, $right);
    }

    private function merge(array &$resultArray, array $left, array $right): void
    {
        $leftIndex = 0;
        $leftArraySize = count($left);
        $rightIndex = 0;
        $rightArraySize = count($right);
        $resultIndex = 0;

        while ($leftIndex < $leftArraySize && $rightIndex < $rightArraySize) {
            if ($this->comparator->isSecondValueGreater($left[$leftIndex], $right[$rightIndex]) ) {
                $resultArray[$resultIndex++] = $left[$leftIndex++];
                continue;
            }

            $resultArray[$resultIndex++] = $right[$rightIndex++];
        }

        $this->appendRemainingValues($resultArray, $resultIndex, $left, $leftIndex);
        $this->appendRemainingValues($resultArray, $resultIndex, $right, $rightIndex);
    }

    private function appendRemainingValues(array &$arrayResult, int &$resultIndex, array $array, int $index): void
    {
        $arraySize = count($array);
        while ($index < $arraySize) {
            $arrayResult[$resultIndex++] = $array[$index++];
        }
    }
}
