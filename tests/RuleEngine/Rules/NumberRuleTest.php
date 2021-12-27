<?php

declare(strict_types = 1);

namespace Tests\RuleEngine\Rules;

use PHPUnit\Framework\TestCase;
use RuleEngine\Rules\NumberRule;

final class NumberRuleTest extends TestCase
{
    private NumberRule $rule;

    protected function setUp(): void
    {
        $this->rule = new NumberRule();
    }

    public function test_password_without_any_number_is_failing(): void
    {
        self::assertFalse($this->rule->apply('ABCDEFGH'));
    }

    public function test_password_with_one_number_is_passing(): void
    {
        self::assertTrue($this->rule->apply('ABCd9EFGH'));
    }
}
