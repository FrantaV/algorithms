<?php

namespace Algorithms\Sort;

use Algorithms\ArrayUtils;
use Algorithms\Comparator\ComparatorInterface;

// Time Complexity
// * Best: θ(n)
// * Worst: θ(n^2)
// * Average: θ(n^2)
// * Space Complexity: O(1)
// * Stability: Yes
//
// Advantages of Shaker Sort
// * Cocktail sort can be more efficient than bubble sort in certain cases, especially when the array being sorted
//   has a small number of unsorted elements near the end.
// * Cocktail sort is a simple algorithm to understand and implement, making it a good choice for educational
//   purposes or for sorting small datasets.
//
// Disadvantages of Shaker Sort
// * Cocktail sort has a worst-case time complexity of θ(n^2), which means that it can be slow for large datasets
//   or datasets that are already partially sorted.
// * Cocktail sort requires additional bookkeeping to keep track of the starting and ending indices of the subarrays
//   being sorted in each pass, which can make the
// * algorithm less efficient in terms of memory usage than other sorting algorithms.
// * There are more efficient sorting algorithms available, such as merge sort and quicksort, that have better
//   average-case and worst-case time complexity than cocktail sort.

class ShakerSort implements SortInterface
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $startIndex = 0;
        $endIndex = count($arrayToSort) - 1;
        $swapped = false;

        do {
            for ($currentIndex = $startIndex; $currentIndex < $endIndex; $currentIndex++) {
                $followingIndex = $currentIndex + 1;
                if ($this->comparator->isSecondValueLower($arrayToSort[$currentIndex], $arrayToSort[$followingIndex])) {
                    ArrayUtils::swapValues($arrayToSort, $currentIndex, $followingIndex);
                    $swapped = true;
                }
            }

            if ($swapped === false) {
                break;
            }

            $swapped = false;
            $endIndex--;

            for ($currentIndex = $endIndex - 1; $currentIndex >= $startIndex; $currentIndex--) {
                $followingIndex = $currentIndex + 1;
                if ($this->comparator->isSecondValueLower($arrayToSort[$currentIndex], $arrayToSort[$followingIndex])) {
                    ArrayUtils::swapValues($arrayToSort, $currentIndex, $followingIndex);
                    $swapped = true;
                }
            }

            $startIndex++;
        } while ($swapped === true);
    }
}
