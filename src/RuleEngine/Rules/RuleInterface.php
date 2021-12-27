<?php

declare(strict_types = 1);

namespace RuleEngine\Rules;

interface RuleInterface
{
    public function apply(string $password): bool;
}
