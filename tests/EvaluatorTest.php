<?php

declare(strict_types = 1);

namespace Tests;

use ComparisonCondition;
use Evaluator\ComparisonEvaluator;
use Evaluator\IntegerValueEvaluator;
use Evaluator\PropertyAccessValueEvaluator;
use ExpressionEvaluator;
use IntegerValue;
use PHPUnit\Framework\TestCase;
use PropertyAccessValue;

final class EvaluatorTest extends TestCase
{
    public function test_it_evaluates_smaller_than(): void
    {
        # expression: cart.total < 10
        # data:       ['cart' => ['total' => 50]]
        # 50 < 10
        # false
        $expression = (new ComparisonCondition(
            new PropertyAccessValue('[cart][total]'),
            '<',
            new IntegerValue(10)
        ));
        $evaluator = new ExpressionEvaluator([
            new ComparisonEvaluator(),
            new PropertyAccessValueEvaluator(),
            new IntegerValueEvaluator()
        ]);

        self::assertFalse($evaluator->evaluate($expression, ['cart' => ['total' => 50]]));
    }

    public function test_it_evaluates_greater_than(): void
    {
        $expression = (new ComparisonCondition(
            new PropertyAccessValue('[cart][total]'),
            '>',
            new IntegerValue(10)
        ));
        $evaluator = new ExpressionEvaluator([
            new ComparisonEvaluator(),
            new PropertyAccessValueEvaluator(),
            new IntegerValueEvaluator()
        ]);

        self::assertTrue($evaluator->evaluate($expression, ['cart' => ['total' => 50]]));
    }

    public function test_it_evaluates_equals(): void
    {
        $expression = (new ComparisonCondition(
            new PropertyAccessValue('[cart][total]'),
            '=',
            new IntegerValue(50)
        ));
        $evaluator = new ExpressionEvaluator([
            new ComparisonEvaluator(),
            new PropertyAccessValueEvaluator(),
            new IntegerValueEvaluator()
        ]);

        self::assertTrue($evaluator->evaluate($expression, ['cart' => ['total' => 50]]));
    }
    # Rule Engine:
    # <, > , = , <= , >=, contains, not expression (will negate anything that it gets)
    # &&, ||, XOR, LogicEvaluator, BooleanValue

    # Expression Engine:
    # expression: ArithmeticOperator +, *, : (ExpressionEngine)
}
