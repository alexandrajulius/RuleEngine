<?php

declare(strict_types = 1);

namespace Tests;

use EvaluatorFactory;
use Expression\LogicalExpression;
use Expression\PropertyExpression;
use ExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class LogicalEvaluatorTest extends TestCase
{
    public function test_it_performs_logical_disjunction(): void
    {
        # INPUT:
        # expression: [cart][items][product_id_1][shipping_flatrate] | [cart][items][product_id_2][shipping_flatrate]
        # data:       ['cart' =>
        #               ['items' => [
        #                   'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 10.00],
        #                   'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00]
        #               ]]
        #           ];

        # EVALUATION:
        # true | false

        # OUTPUT:
        # true

        $data = ['cart' =>
            ['items' => [
                'product_id_1' => ['shipping_flatrate' => true],
                'product_id_2' => ['shipping_flatrate' => false]
            ]]
        ];

        $expression = $this->createArithmeticExpression(
            '[cart][items][product_id_1][shipping_flatrate]',
            '|',
            '[cart][items][product_id_2][shipping_flatrate]');

        $evaluator = $this->getEvaluator();

        self::assertEquals(true, $evaluator->evaluate($expression, $data));
    }

    private function createArithmeticExpression(string $left, string $operator, string $right): LogicalExpression
    {
        return (new LogicalExpression(
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
