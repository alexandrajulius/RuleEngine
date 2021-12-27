<?php

declare(strict_types = 1);

namespace RuleEngine;

use RuleEngine\Rules\RuleInterface;

final class RuleEngine {

    /**
     * @var list<RuleInterface>
     */
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate(string $password): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->apply($password)) {
                return false;
            }
        }

        return true;
    }
}
