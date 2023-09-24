<?php

namespace Algorithms\Search;
interface SearchAlgorithmInterface {
    public const NOT_FOUND = -1;

    public function findIndexOfValue(array $sortedArray, int $searchedValue): int;
}
