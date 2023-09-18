<?php

declare(strict_types=1);

namespace Algorithms\Sort;

use Algorithms\ArrayUtils;
use Algorithms\Comparator\ComparatorInterface;

// Time Complexity
// * Best: θ(nlog n)
// * Worst: θ(nlog n)
// * Average: θ(nlog n)
// * Space Complexity: O(1)
// * Stability: No
//
// Applications of Heap Sort
// Heap sort has limited usage since algorithms like "merge sort" and "quicksort" are better in practice. Heaps are used
// for problems like getting the largest or smallest elements in an array, sorting an almost sorted array, etc.
//
// Some Index applications of Heap sort include:
// * Implementation of priority queues
// * Security systems
// * Embedded systems (for example, Linux Kernel)

class HeapSort implements SortInterface
{
    private array $arrayToSort = [];
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function sort(array &$arrayToSort): void
    {
        $this->arrayToSort = &$arrayToSort;
        $sizeOfHeap = count($this->arrayToSort);

        $this->buildHeap($sizeOfHeap);
        $this->sortHeap($sizeOfHeap);

    }

    private function buildHeap(int $sizeOfHeap): void
    {
        $startIndex = (int)(($sizeOfHeap / 2) - 1);
        for ($index = $startIndex; $index >= 0; $index--) {
            $this->heapify($sizeOfHeap, $index);
        }
    }

    private function sortHeap(int $sizeOfHeap): void
    {
        $endIndex = $sizeOfHeap - 1;
        $firstIndex = 0;
        for ($currentIndex = $endIndex; $currentIndex > $firstIndex; $currentIndex--) {
            ArrayUtils::swapValues($this->arrayToSort, $firstIndex, $currentIndex);
            $this->heapify($currentIndex, $firstIndex);
        }
    }

    private function heapify(int $sizeOfHeap, int $rootNodeIndex): void
    {
        $largestNodeIndex = $rootNodeIndex;
        $leftChildIndex = 2 * $rootNodeIndex + 1;
        $largestNodeIndex = $this->getLargestNodeIndex($leftChildIndex, $largestNodeIndex, $sizeOfHeap);
        $rightChildIndex = 2 * $rootNodeIndex + 2;
        $largestNodeIndex = $this->getLargestNodeIndex($rightChildIndex, $largestNodeIndex, $sizeOfHeap);

        $isRootLargestNode = $largestNodeIndex !== $rootNodeIndex;
        if ($isRootLargestNode) {
            ArrayUtils::swapValues( $this->arrayToSort, $rootNodeIndex, $largestNodeIndex);
            $this->heapify($sizeOfHeap, $largestNodeIndex);
        }
    }

    private function getLargestNodeIndex(int $firstNodeIndex, int $secondNodeIndex, int $sizeOfHeap): int
    {
        $isFirstNodeLarger =
            $firstNodeIndex < $sizeOfHeap
            && $this->comparator->isSecondValueLower($this->arrayToSort[$firstNodeIndex], $this->arrayToSort[$secondNodeIndex]);

        return $isFirstNodeLarger ? $firstNodeIndex : $secondNodeIndex;
    }
}
