<?php

declare(strict_types = 1);

namespace Tests;

use EngineFactory;
use Expression\ComparisonExpression;
use Engine;
use Expression\IntegerExpression;
use Expression\PropertyExpression;
use PHPUnit\Framework\TestCase;

final class ComparisonEvaluatorTest extends TestCase
{
    public function test_it_evaluates_smaller_than(): void
    {
        # input:
        # expression: cart.total < 10
        # data:       ['cart' => ['total' => 50]]
        # evaluation:
        # 50 < 10
        # output:
        # false
        $expression = $this->createComparisonExpression(
            '[cart][total]',
            '<',
            10);

        self::assertFalse(
            $this->getEngine()->evaluate($expression, ['cart' => ['total' => 50]])
        );
    }

    public function test_it_evaluates_greater_than(): void
    {
        $expression = $this->createComparisonExpression(
            '[cart][total]',
            '>',
            10);

        self::assertTrue(
            $this->getEngine()->evaluate($expression, ['cart' => ['total' => 50]])
        );
    }

    public function test_it_evaluates_equals(): void
    {
        $expression = $this->createComparisonExpression(
            '[cart][total]',
                '=',
                50);

        self::assertTrue(
            $this->getEngine()->evaluate($expression, ['cart' => ['total' => 50]])
        );
    }

    private function createComparisonExpression(string $left, string $operator, int $right): ComparisonExpression
    {
        return (new ComparisonExpression(
            new PropertyExpression($left),
            $operator,
            new IntegerExpression($right)
        ));
    }

    private function getEngine(): Engine
    {
        return (new EngineFactory())->createEngine();
    }
}
