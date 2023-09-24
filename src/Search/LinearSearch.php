<?php

declare(strict_types=1);

namespace Algorithms\Search;

use Algorithms\Comparator\ComparatorInterface;

class LinearSearch implements SearchAlgorithmInterface {
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }

    public function findIndexOfValue(array $sortedArray, int $searchedValue): int {
        if (array_is_list($sortedArray) === false ) {
            throw new \UnexpectedValueException('Array isn\'t a list.');
        }

        foreach ($sortedArray as $key => $value) {
            if ($this->comparator->areValuesEqual($value, $searchedValue)) {
                return $key;
            }
        }
        return SearchAlgorithmInterface::NOT_FOUND;
    }
}
