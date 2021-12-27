<?php

declare(strict_types = 1);

namespace Tests\RuleEngine\Rules;

use PHPUnit\Framework\TestCase;
use RuleEngine\Rules\LengthRule;

final class LengthRuleTest extends TestCase
{
    private LengthRule $rule;

    protected function setUp(): void
    {
        $this->rule = new LengthRule();
    }

    public function test_password_password_with_less_then_8_chars_is_failing(): void
    {
        self::assertFalse($this->rule->apply('abcdefg'));
    }

    public function test_password_with_8_or_more_chars_is_passing(): void
    {
        self::assertTrue($this->rule->apply('abcdefgh'));
    }
}
