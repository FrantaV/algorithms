<?php

declare(strict_types=1);

namespace Tests\Unit\Sort;

use Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractSortTestCase extends TestCase
{
    public static function provideSortData(): Generator
    {
        yield 'Empty_array' => [
            [],
            [],
        ];

        yield 'Same_array' => [
            [1, 2, 3, 4, 5],
            [1, 2, 3, 4, 5],
        ];

        yield 'Small_array' => [
            [3, 1, 5, 2, 4],
            [1, 2, 3, 4, 5],
        ];

        yield 'Dataset_3' => [
            [3, 1, 2, 4, 5, 9, 7, 6, 8, 10, 15, 12, 11, 13, 14, 20, 19, 16, 18, 17],
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
        ];

        yield 'Dataset_4' => [
            [5, 12, 9, 3, 6, 1, 22, 28, 16, 7, 30, 25, 14, 10, 20, 15, 19, 26, 23, 8, 4],
            [1, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 15, 16, 19, 20, 22, 23, 25, 26, 28, 30],
        ];

        yield 'Dataset_5' => [
            [
                30,
                22,
                29,
                3,
                16,
                21,
                8,
                18,
                27,
                6,
                11,
                15,
                4,
                12,
                24,
                19,
                26,
                10,
                20,
                14,
                9,
                5,
                28,
                25,
                23,
                7,
                2,
                17,
                13
            ],
            [
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
                14,
                15,
                16,
                17,
                18,
                19,
                20,
                21,
                22,
                23,
                24,
                25,
                26,
                27,
                28,
                29,
                30
            ],
        ];
    }
}
