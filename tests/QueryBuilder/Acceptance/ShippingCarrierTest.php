<?php

declare(strict_types = 1);

namespace Tests\QueryBuilder\Acceptance;

use QueryBuilder\EngineFactory;
use QueryBuilder\Expression\ClosureExpression;
use QueryBuilder\Expression\IfExpression;
use QueryBuilder\Expression\IntegerExpression;
use QueryBuilder\Expression\SumExpression;
use QueryBuilder\Engine;
use PHPUnit\Framework\TestCase;

/**
 * Shipping Carrier (DHL, DPD, UPS, …)
 *  we would iterate overall items and find the carrier with the highest priority

 *  IF we have the case, that there’s no common profile for all cart items we choose the one with the most matches

 *   CartItem 1: 1. DHL 10€, 2. DPD 20€
 *   CartItem 2: 1. DPD 10€
 *       => The whole cart has to be DPD => 30€
 */
final class ShippingCarrierTest extends TestCase
{
    public function test_it_returns_shipping_carrier_with_most_matches(): void
    {
        $data = ['cart' =>
                    ['items' => [
                        'product_id_1' => [
                            'shipping' => [
                                'free' => false,
                                'carrier' => [
                                    'name' => 'DHL', 'cost' => 10.00
                                    //['name' => 'DPD', 'cost' => 20.00]
                                ]]],
                        'product_id_2' => [
                            'shipping' => [
                                'free' => false,
                                'carrier' => [
                                    'name' => 'DPD', 'cost' => 10.00
                                ]]],
                        ]
                    ]
                ];

        self::assertEquals(
            20,
            $this->getEngine()->evaluate($this->createRule(), $data)
        );
    }

    private function getEngine(): Engine
    {
        return (new EngineFactory())->createEngine();
    }

    private function createRule(): IfExpression
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
                        if ($item['shipping']['free']) {
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
                    fn(array $data) => array_map(fn(array $item) => $item['shipping']['carrier']['cost'], $data['cart']['items'])
                )
            )
        );
    }
}
