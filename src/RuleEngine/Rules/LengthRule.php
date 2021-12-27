<?php

declare(strict_types = 1);

namespace RuleEngine\Rules;

use Exception;

final class LengthRule implements RuleInterface
{
    private const MIN_PASSWORD_LENGTH = 8;

    public function apply(string $password): bool
    {
        try {
            assert(strlen($password) >= self::MIN_PASSWORD_LENGTH);
            return true;

        } catch (Exception $exception) {
            return false;
        }
    }
}
