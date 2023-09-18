<?php

declare(strict_types=1);

namespace Algorithms\Comparator;

interface ComparatorInterface
{
    public const GREATER = -1;
    public const EQUAL = 0;
    public const LOWER = 1;

    public function compare($firstValue, $secondValue): int;
    public function isSecondValueGreater($firstValue, $secondValue): bool;
    public function isSecondValueLower($firstValue, $secondValue): bool;
    public function areValuesEqual($firstValue, $secondValue): bool;
}
