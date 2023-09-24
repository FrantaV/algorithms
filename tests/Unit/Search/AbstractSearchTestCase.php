<?php

declare(strict_types=1);

namespace Tests\Unit\Search;

use Algorithms\Search\SearchAlgorithmInterface;
use Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractSearchTestCase extends TestCase {
    public static function provideSearchData(): Generator {
        yield 'Empty_array' => [
            [],
            5,
            SearchAlgorithmInterface::NOT_FOUND,
        ];

        yield 'Small_array' => [
            [1, 2, 3, 4, 5],
            4,
            3
        ];

        yield 'Dataset_3' => [
            [1, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 15, 16, 19, 20, 22, 23, 25, 26, 28, 30],
            15,
            11
        ];

        yield 'Dataset_4' => [
            [1, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 15, 16, 19, 20, 22, 23, 25, 26, 28, 30],
            40,
            SearchAlgorithmInterface::NOT_FOUND
        ];

    }

    protected function getInvalidListTypeArray(): array {
        return [0 => 1, 'foo' => 2];
    }
}
