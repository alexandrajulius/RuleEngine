<?php

declare(strict_types = 1);

namespace Tests;

use Closure;
use EvaluatorFactory;
use Expression\ArithmeticExpression;
use Expression\ListExpression;
use Expression\ClosureExpression;
use Expression\PropertyExpression;
use ExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class ClosureEvaluatorTest extends TestCase
{
    public function test_it_maps(): void
    {
        # INPUT:
        # expression: [cart][items][product_id_1][shipping_cost] + [cart][items][product_id_2][shipping_cost]
        # data:       ['cart' =>
        #                   ['items' => [
        #                       'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 0.00],
        #                       'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
        #                       'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
        #                   ]
        #               ]
        #            ];

        # EVALUATION:
        # 10.00 + 20.00

        # OUTPUT:
        # 30.00

        $data = ['cart' =>
                           ['items' => [
                               'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 0.00],
                               'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
                               'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
                           ]
                       ]
                    ];

        $expression = $this->createClosureEvaluator(
            function(array $data){
                return array_values(array_map(fn(array $item) => $item['shipping_cost'], $data['cart']['items']));
            }
        );

        $evaluator = $this->getEvaluator();

        self::assertEquals([0.00, 20.00, 10.00], $evaluator->evaluate($expression, $data));
    }

    private function createClosureEvaluator(Closure $closure): ClosureExpression
    {
        return (new ClosureExpression(
            $closure
        ));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }
}
