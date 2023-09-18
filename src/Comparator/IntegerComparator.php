<?php

declare(strict_types=1);

namespace Algorithms\Comparator;

use UnexpectedValueException;

class IntegerComparator extends AbstractTypeComparator
{
    public function compare($firstValue, $secondValue): int
    {
        $this->checkNodeValidation($firstValue, $secondValue);
        return $firstValue <=> $secondValue;
    }

    protected function checkNodeValidation($firstValue, $secondValue): void {
        if (!$this->areValuesValid($firstValue, $secondValue)) {
            throw new UnexpectedValueException(
                'Comparator expected integers. ' . getType($firstValue) . ' and ' . getType($secondValue) . ' given.'
            );
        }
    }

    protected function isValueValid($value): bool
    {
        return is_int($value);
    }
}
