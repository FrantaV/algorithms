<?php

declare(strict_types=1);

namespace Algorithms\Comparator;

abstract class AbstractTypeComparator implements ComparatorInterface
{

    protected function areValuesValid($firstValue, $secondValue): bool
    {
        return $this->isValueValid($firstValue) && $this->isValueValid($secondValue);
    }

    abstract protected function isValueValid($value): bool;

    public function isSecondValueGreater($firstValue, $secondValue): bool
    {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::GREATER;
    }

    public function isSecondValueLower($firstValue, $secondValue): bool
    {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::LOWER;
    }

    public function areValuesEqual($firstValue, $secondValue): bool
    {
        return $this->compare($firstValue, $secondValue) === ComparatorInterface::EQUAL;
    }
}
