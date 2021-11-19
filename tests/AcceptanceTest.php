<?php

declare(strict_types = 1);

namespace Tests;

use EvaluatorFactory;
use Expression\ClosureExpression;
use Expression\IfExpression;
use Expression\IntegerExpression;
use Expression\SumExpression;
use ExpressionEvaluator;
use PHPUnit\Framework\TestCase;

final class AcceptanceTest extends TestCase
{
    public function test_it_evaluates_a_cart_to_shipping_costs_zero(): void
    {
        $evaluator = $this->getEvaluator();
        $data = ['cart' =>
            ['items' => [
                'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 0.00],
                'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
                'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
            ]
            ]
        ];
        $expression = new IfExpression(
            # IF one item has a shipping_flatrate return true
            new ClosureExpression(
                function($data) {
                    foreach($data['cart']['items'] as $item) {
                        if ($item['shipping_flatrate']) {
                            return true;
                        }
                    }
                    return false;
                }
            ),
            # THEN the total shipping cost is 0
            new IntegerExpression(0),
            # ELSE the total shipping cost is the sum of all item's shipping costs
            new SumExpression(
                new ClosureExpression(
                    fn(array $data) => array_map(fn(array $item) => $item['shipping_cost'], $data['cart']['items'])
                )
            )
        );

        self::assertEquals(0, $evaluator->evaluate($expression, $data));
    }

    public function test_it_evaluates_a_cart_to_shipping_costs_thirty(): void
    {
        $evaluator = $this->getEvaluator();
        $data = ['cart' =>
            ['items' => [
                'product_id_1' => ['shipping_flatrate' => false, 'shipping_cost' => 0.00],
                'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
                'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
            ]
            ]
        ];
        $expression = new IfExpression(
            new ClosureExpression(
                function($data) {
                    foreach($data['cart']['items'] as $item) {
                        if ($item['shipping_flatrate']) {
                            return true;
                        }
                    }
                    return false;
                }
            ),
            new IntegerExpression(0),
            new SumExpression(
                new ClosureExpression(
                    /** @var list<string, double> [product_id => shipping_cost] */
                    fn(array $data) => array_map(fn(array $item) => $item['shipping_cost'], $data['cart']['items'])
                )
            )
        );

        self::assertEquals(30, $evaluator->evaluate($expression, $data));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }
}
