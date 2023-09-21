<?php

declare(strict_types=1);

namespace Algorithms\Sort;

use Algorithms\ArrayUtils;
use Algorithms\Comparator\ComparatorInterface;

// Time Complexity
// * Best: Ω(n)
// * Worst: O(n^2)
// * Average: θ(n^2)
// * Space Complexity: O(1)
// * Stability: Yes
//
// Space Complexity
// * Space complexity is O(1) because an extra variable is used for Average: θping.
// * In the optimized bubble sort algorithm, two extra variables are used. Hence, the space complexity will be O(2).
//
// Bubble sort is used if
// * complexity does not matter
// * short and simple code is preferred

class BubbleSort implements SortInterface
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $arraySize = count($arrayToSort);
        $arrayLastIndex = $arraySize - 1;

        for ($iterationNumber = 0; $iterationNumber < $arrayLastIndex; $iterationNumber++) {
            $isArraySorted = true;
            $endOfSearchRange = $arrayLastIndex - $iterationNumber;

            for ($currentIndex = 0; $currentIndex < $endOfSearchRange; $currentIndex++) {
                $followingIndex = $currentIndex + 1;
                if ($this->comparator->isSecondValueLower($arrayToSort[$currentIndex], $arrayToSort[$followingIndex])) {
                    ArrayUtils::swapValues($arrayToSort, $currentIndex, $followingIndex);
                    $isArraySorted = false;
                }
            }

            if ($isArraySorted === true) {
                break;
            }
        }
    }
}
