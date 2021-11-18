<?php

declare(strict_types = 1);

namespace Tests;

use EvaluatorFactory;
use Expression\ArithmeticExpression;
use Expression\PropertyExpression;
use ExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class ArithmeticEvaluatorTest extends TestCase
{
    public function test_it_sums_up(): void
    {
        # INPUT:
        # expression: [cart][items][product_id_1][shipping_cost] + [cart][items][product_id_2][shipping_cost]
        # data:       ['cart' =>
        #               ['items' => [
        #                   'product_id_1' => ['shipping_cost' => 10.00],
        #                   'product_id_2' => ['shipping_cost' => 20.00]
        #               ]]
        #           ];

        # EVALUATION:
        # 10.00 + 20.00

        # OUTPUT:
        # 30.00

        $data = ['cart' =>
            ['items' => [
                'product_id_1' => ['shipping_cost' => 10.00],
                'product_id_2' => ['shipping_cost' => 20.00]
            ]]
        ];

        $expression = $this->createArithmeticExpression(
            '[cart][items][product_id_1][shipping_cost]',
            '+',
            '[cart][items][product_id_2][shipping_cost]');

        $evaluator = $this->getEvaluator();

        self::assertEquals(30.00, $evaluator->evaluate($expression, $data));
    }

    private function createArithmeticExpression(string $left, string $operator, string $right): ArithmeticExpression
    {
        return (new ArithmeticExpression(
            new PropertyExpression($left),
            $operator,
            new PropertyExpression($right)
        ));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }
}
