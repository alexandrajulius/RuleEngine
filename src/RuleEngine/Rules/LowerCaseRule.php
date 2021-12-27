<?php

declare(strict_types = 1);

namespace RuleEngine\Rules;

use Exception;

final class LowerCaseRule implements RuleInterface
{
    public function apply(string $password): bool
    {
        try {
            assert(preg_match('/[a-z]/', $password) !== 0);

            # assert($password === strtolower($password));
            return true;

        } catch (Exception $exception) {
            return false;
        }
    }
}
