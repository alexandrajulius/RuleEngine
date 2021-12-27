<?php

declare(strict_types = 1);

namespace Tests\RuleEngine\Rules;

use PHPUnit\Framework\TestCase;
use RuleEngine\Rules\LowerCaseRule;

final class LowerCaseRuleTest extends TestCase
{
    private LowerCaseRule $rule;

    protected function setUp(): void
    {
        $this->rule = new LowerCaseRule();
    }

    public function test_password_without_any_lowercase_letter_is_failing(): void
    {
        self::assertFalse($this->rule->apply('ABCDEFGH'));
    }

    public function test_password_with_one_lowercase_letter_is_passing(): void
    {
        self::assertTrue($this->rule->apply('ABCdEFGH'));
    }
}
