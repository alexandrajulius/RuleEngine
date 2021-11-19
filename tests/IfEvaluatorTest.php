<?php

declare(strict_types = 1);

namespace Tests;

use EvaluatorFactory;
use Expression\BooleanExpression;
use Expression\IfExpression;
use Expression\IntegerExpression;
use ExpressionEvaluator;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\TestCase;

final class IfEvaluatorTest extends TestCase
{
    public function test_it_returns_result_if_true(): void
    {
        $evaluator = $this->getEvaluator();
        $expression = new IfExpression(new BooleanExpression(true), new IntegerExpression(1));

        self::assertEquals(1, $evaluator->evaluate($expression, []));
    }

    public function test_it_returns_null_if_false(): void
    {
        $evaluator = $this->getEvaluator();
        $expression = new IfExpression(new BooleanExpression(false), new IntegerExpression(1));

        self::assertEquals(null, $evaluator->evaluate($expression, []));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }
}
