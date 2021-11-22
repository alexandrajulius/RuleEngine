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

final class ShippingCostsAcceptanceTest extends TestCase
{
    public function test_it_returns_zero_shipping_costs_if_one_item_has_flatrate(): void
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

        self::assertEquals(0, $evaluator->evaluate($this->calculateShippingCostsRule(), $data));
    }

    public function test_it_returns_sum_of_all_items_shipping_costs(): void
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

        self::assertEquals(30, $evaluator->evaluate($this->calculateShippingCostsRule(), $data));
    }

    public function test_it_calculates_shipping_for_non_empty_cart(): void
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

        self::assertEquals(30, $evaluator->evaluate($this->createCompleteShippingCostsRule(), $data));
    }

    public function test_it_returns_zero_empty_cart(): void
    {
        $evaluator = $this->getEvaluator();
        $data = ['cart' =>
            ['items' => []]
        ];

        self::assertEquals(0, $evaluator->evaluate($this->createCompleteShippingCostsRule(), $data));
    }

    private function getEvaluator(): ExpressionEvaluator
    {
        return (new EvaluatorFactory())->createExpressionEvaluator();
    }

    private function createCompleteShippingCostsRule(): IfExpression
    {
        return new IfExpression(
            # IF not cart empty
            new ClosureExpression(
                function(array $data) {
                    if (!empty($data['cart']['items'])) {
                        return true;
                    }
                    return false;
                }
            ),
            # THEN return calculated shipping costs
            $this->calculateShippingCostsRule(),
            # ELSE return 0
            new IntegerExpression(0),
        );
    }

    private function calculateShippingCostsRule(): IfExpression
    {
        return new IfExpression(
            # IF one item has a shipping_flatrate
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
    }
}
