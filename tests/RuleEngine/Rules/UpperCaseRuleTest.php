<?php

declare(strict_types = 1);

namespace Tests\RuleEngine\Rules;

use PHPUnit\Framework\TestCase;
use RuleEngine\Rules\UpperCaseRule;

final class UpperCaseRuleTest extends TestCase
{
    private UppercaseRule $rule;

    protected function setUp(): void
    {
        $this->rule = new UppercaseRule();
    }

    public function test_password_without_any_uppercase_letter_is_failing(): void
    {
        self::assertFalse($this->rule->apply('abcdefgh'));
    }

    public function test_password_with_one_uppercase_letter_is_passing(): void
    {
        self::assertTrue($this->rule->apply('abcDefgh'));
    }
}
