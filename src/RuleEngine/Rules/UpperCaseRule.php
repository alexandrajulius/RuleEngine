<?php

declare(strict_types = 1);

namespace RuleEngine\Rules;

use Exception;

final class UpperCaseRule implements RuleInterface
{
    public function apply(string $password): bool
    {
        try {
            assert(preg_match('/[A-Z]/', $password) !== 0);
            return true;

        } catch (Exception $exception) {
            return false;
        }
    }
}
