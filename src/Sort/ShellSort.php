<?php

declare(strict_types=1);

namespace Algorithms\Sort;

// Time Complexity
// * Best: Ω(nlog n)
// * Worst: O(n^2)
// * Average: θ(nlog n)
// * Space Complexity: O(1)
// * Stability: No
//
// Advantages of Shell Sort
// * Implementation is easy.
// * No stack call is required.
// * Shell sort is efficient when given data is already almost sorted.
// * Shell sort is an in-place sorting algorithm.
//
// Disadvantages of Shell Sort
// * Shell sort is inefficient when the data is highly unsorted.
// * Shell sort is not efficient for large arrays.
//
// Shell Sort vs. Quicksort
// * On average, quicksort performs better than shell sort; but shell sort is more efficient than quicksort
//   when the given data is already/almost sorted.
// * Shell sort does not require stack calls, whereas quicksort does.

use Algorithms\Comparator\ComparatorInterface;

class ShellSort implements SortInterface
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $arraySize = count($arrayToSort);
        $startGap = (int)($arraySize / 2);
        // Halve the "gap" in a binary way
        for ($gap = $startGap; $gap > 0; $gap = (int)($gap / 2)) {
            // Traverse from the middle to the end
            for ($currentIndex = $gap; $currentIndex < $arraySize; $currentIndex++) {
                $currentValue = $arrayToSort[$currentIndex];
                // Move back from "currentIndex" in steps of "gap"
                // The condition is that we must not go beyond the zeroth index of the array,
                // and the value must be greater than "temp".
                // [][][][][][][][][]
                //      |____|
                // |____|
                for (
                    $comparisonIndex = $currentIndex
                ; $comparisonIndex >= $gap && $this->comparator->isSecondValueLower($arrayToSort[$comparisonIndex - $gap], $currentValue)
                ; $comparisonIndex -= $gap
                ) {
                    $arrayToSort[$comparisonIndex] = $arrayToSort[$comparisonIndex - $gap];
                }
                // Place the "current value" in the correct position
                $arrayToSort[$comparisonIndex] = $currentValue;
            }
        }
    }
}
