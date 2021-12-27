<?php

declare(strict_types = 1);

namespace Tests\RuleEngine;

use PHPUnit\Framework\TestCase;
use RuleEngine\RuleEngine;
use RuleEngine\Rules\RuleInterface;

final class RuleEngineTest extends TestCase
{
    public function test_password_validation_without_rules_is_passing(): void
    {
        $validator = new RuleEngine([]);

        $this->assertTrue($validator->validate(''));
    }

    public function test_password_validation_with_one_passing_rule_is_passing(): void
    {
        $rule1 = $this->createMock(RuleInterface::class);
        $rule1->method('apply')->willReturn(true);

        $validator = new RuleEngine([
            $rule1
        ]);

        $this->assertTrue($validator->validate(''));
    }

    public function test_password_validation_with_one_failing_rule_is_failing(): void
    {
        $rule1 = $this->createMock(RuleInterface::class);
        $rule1->method('apply')->willReturn(false);

        $validator = new RuleEngine([
            $rule1
        ]);

        $this->assertFalse($validator->validate(''));
    }

    public function test_password_validation_with_one_passing_and_one_failing_rule_is_failing(): void
    {
        $rule1 = $this->createMock(RuleInterface::class);
        $rule1->method('apply')->willReturn(true);

        $rule2 = $this->createMock(RuleInterface::class);
        $rule2->method('apply')->willReturn(false);

        $validator = new RuleEngine([
            $rule1,
            $rule2,
        ]);

        $this->assertFalse($validator->validate(''));
    }

    public function test_password_validation_with_all_rules_passing_is_passing(): void
    {
        $rule1 = $this->createMock(RuleInterface::class);
        $rule1->method('apply')->willReturn(true);

        $rule2 = $this->createMock(RuleInterface::class);
        $rule2->method('apply')->willReturn(true);

        $validator = new RuleEngine([
            $rule1,
            $rule2,
        ]);

        $this->assertTrue($validator->validate(''));
    }
}
