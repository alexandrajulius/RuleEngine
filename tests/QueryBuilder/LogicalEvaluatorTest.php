<?php

declare(strict_types = 1);

namespace Tests\QueryBuilder;

use QueryBuilder\EngineFactory;
use QueryBuilder\Expression\LogicalExpression;
use QueryBuilder\Expression\PropertyExpression;
use QueryBuilder\Engine;
use PHPUnit\Framework\TestCase;

final class LogicalEvaluatorTest extends TestCase
{
    public function test_it_performs_logical_disjunction(): void
    {
        # INPUT:
        # expression: [cart][items][product_id_1][shipping_flatrate] | [cart][items][product_id_2][shipping_flatrate]
        # data:       ['cart' =>
        #               ['items' => [
        #                   'product_id_1' => ['shipping_flatrate' => true],
        #                   'product_id_2' => ['shipping_flatrate' => false]
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

        $expression = $this->createLogicalExpression(
            '[cart][items][product_id_1][shipping_flatrate]',
            '|',
            '[cart][items][product_id_2][shipping_flatrate]');

        self::assertEquals(
            true,
            $this->getEngine()->evaluate($expression, $data)
        );
    }

    private function createLogicalExpression(string $left, string $operator, string $right): LogicalExpression
    {
        return (new LogicalExpression(
            new PropertyExpression($left),
            $operator,
            new PropertyExpression($right)
        ));
    }

    private function getEngine(): Engine
    {
        return (new EngineFactory())->createEngine();
    }
}
