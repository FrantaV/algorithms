<?php

declare(strict_types=1);

namespace Algorithms\Sort;

// Time Complexity
// * Best: θ(n)
// * Worst: θ(n^2)
// * Average: θ(n^2)
// * Space Complexity: O(1)
// * Stability: Yes
//
// Advantages of Insertion Sort
// * On average, insertion performs fewer comparisons than other quadratic sorting algorithms such as bubble sort
//   and selection sort.
// * It is a stable sorting algorithm, as it does not change the relative order of elements with equal values.
// * It is adaptive, which means it performs a lesser number of operations if a partially sorted array is provided
//   as input, making it efficient.
// * It is an in-place algorithm — requires O(1) additional space.
// * It is online — it can start sorting the data even if the entire dataset is not available right from the beginning.
//
// Disadvantages of Insertion Sort
// * Its time complexity is quadratic, so it is not efficient for large data sets.

use Algorithms\Comparator\ComparatorInterface;

class InsertSort implements SortInterface
{
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $arraySize = count($arrayToSort);
        $startIndex = 1;

        for ($currentIndex = $startIndex; $currentIndex < $arraySize; $currentIndex++) {
            $currentValue = $arrayToSort[$currentIndex];
            $previousIndex = $currentIndex - 1;
            $this->moveValueBeforeGreaterValues($arrayToSort, $previousIndex, $currentValue);
        }
    }

    private function moveValueBeforeGreaterValues(array &$arrayToSort, $previousIndex, $currentValue): void
    {
        while (
            $previousIndex >= 0
            && $this->comparator->isSecondValueGreater($currentValue, $arrayToSort[$previousIndex])
        ) {
            $arrayToSort[$previousIndex + 1] = $arrayToSort[$previousIndex];
            $previousIndex--;
        }

        $arrayToSort[$previousIndex + 1] = $currentValue;
    }
}
