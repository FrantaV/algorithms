<?php

namespace Algorithms\Sort;

use Algorithms\ArrayUtils;
use Algorithms\Comparator\ComparatorInterface;

// Time Complexity
// * Best: Ω(nlog n)
// * Worst: O(n^2)
// * Average: θ(nlog n)
// * Space Complexity: O(log n)
// * Stability: No
//
// Advantages of Merge Sort
// * It works rapidly and effectively.
// * It has the best time complexity when compared to other sorting algorithms.
// * Quick sort has a space complexity of O(logn), making it an excellent choice for situations when space is limited.
//
// Disadvantages of Merge Sort
// * Is slower for smaller lists compared to other sorting algorithms
// * Takes up more space
// * Requires additional memory for sorting, apart from the given array

class QuickSort implements SortInterface {
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void {
        $endIndex = count($arrayToSort) - 1;
        $startIndex = 0;
        $this->quicksort($arrayToSort, $startIndex, $endIndex);

    }

    private function quicksort(&$arrayToSort, $startIndex, $endIndex): void {
        if ($startIndex < $endIndex) {
            $pivotIndex = $this->findPivot($arrayToSort, $startIndex, $endIndex);
            $this->quicksort($arrayToSort, $startIndex, $pivotIndex - 1);
            $this->quicksort($arrayToSort, $pivotIndex + 1, $endIndex);
        }
    }

    private function findPivot(&$arrayToSort, $startIndex, $endIndex): int {
        $pivot = $arrayToSort[$endIndex];
        $lastSmallerValueIndex = $startIndex - 1;

        for ($currentIndex = $startIndex; $currentIndex < $endIndex; $currentIndex++) {
            if ($this->comparator->isSecondValueGreater($arrayToSort[$currentIndex], $pivot)) {
                $lastSmallerValueIndex++;
                ArrayUtils::swapValues($arrayToSort, $lastSmallerValueIndex, $currentIndex);
            }
        }

        $lastSmallerValueIndex++;
        ArrayUtils::swapValues($arrayToSort, $lastSmallerValueIndex, $endIndex);
        return $lastSmallerValueIndex;
    }
}
