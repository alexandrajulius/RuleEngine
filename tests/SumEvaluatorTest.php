<?php

declare(strict_types = 1);

namespace Tests;

use EvaluatorFactory;
use Expression\IntegerExpression;
use Expression\ListExpression;
use Expression\SumExpression;
use ExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class SumEvaluatorTest extends TestCase
{
    public function test_it_sums_up_a_list_of_integers(): void
    {
        $data = [];
        $evaluator = $this->getEvaluator();

        $expression = new SumExpression(new ListExpression([
            new IntegerExpression(1),
            new IntegerExpression(2),
            new IntegerExpression(3)
        ]));

        self::assertEquals(6, $evaluator->evaluate($expression, $data));
    }

    public function test_it_sums_up_one_integer(): void
    {
        $data = [];
        $evaluator = $this->getEvaluator();

        $expression = new SumExpression(new ListExpression([
            new IntegerExpression(1)
        ]));

        self::assertEquals(1, $evaluator->evaluate($expression, $data));
    }

    public function test_it_sums_up_one_integer_without_a_list(): void
    {
        $data = [];
        $evaluator = $this->getEvaluator();

        $expression = new SumExpression(new IntegerExpression(1));

        self::assertEquals(1, $evaluator->evaluate($expression, $data));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }
}
